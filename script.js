let chatBox = document.getElementById('chatBox');
let userInput = document.getElementById('userInput');

// Initial greeting
window.onload = function() {
    addMessage("Bot", "Hello! I can help you find Filipino dishes suitable for your health condition. Feel free to describe your situation, and I'll recommend suitable dishes. (e.g., 'I have diabetes and need food suggestions' or 'What can I eat with hypertension?')");
};

function sendMessage() {
    let message = userInput.value.trim().toLowerCase();
    if (message === '') return;

    // Add user message to chat
    addMessage("User", message);
    
    // Process the message and get response
    let response = processUserInput(message);
    
    // Add bot response to chat
    addMessage("Bot", response);
    
    // Clear input
    userInput.value = '';
}

function processUserInput(input) {
    // Get all health conditions from our data
    const healthConditions = Object.keys(filipinoCuisineData.healthConditions);
    
    // Find all mentioned health conditions in the input
    const foundConditions = healthConditions.filter(condition => 
        input.includes(condition)
    );
    
    if (foundConditions.length > 0) {
        let response = '';
        
        if (foundConditions.length > 1) {
            response = "I found multiple health conditions in your message. Here are recommendations for each:\n\n";
        }
        
        foundConditions.forEach((condition, index) => {
            const healthData = filipinoCuisineData.healthConditions[condition];
            
            response += `${foundConditions.length > 1 ? `For ${condition}:\n` : `For people with ${condition}, I recommend:\n\n`}`;
            
            // Add recommendations
            response += "Recommended dishes:\n";
            healthData.recommendations.forEach(dish => {
                const dishData = filipinoCuisineData.dishes.find(d => d.name === dish);
                if (dishData) {
                    response += `• ${dishData.name} - ${dishData.description}\n`;
                    if (dishData.healthBenefits.length > 0) {
                        response += `  Health benefits: ${dishData.healthBenefits.join(", ")}\n`;
                    }
                    if (dishData.alternatives) {
                        response += `  Tip: ${dishData.alternatives}\n`;
                    }
                }
            });
            
            // Add foods to avoid
            response += "\nFoods to avoid:\n";
            healthData.avoidance.forEach(food => {
                response += `• ${food}\n`;
            });
            
            // Add tips
            response += `\nTip: ${healthData.tips}`;
            
            // Add separator between multiple conditions
            if (index < foundConditions.length - 1) {
                response += "\n\n-------------------\n\n";
            }
        });
        
        return response;
    } else {
        return "I couldn't identify any specific health conditions in your message. Please mention conditions like diabetes, hypertension, heart disease, obesity, or gout. You can write in complete sentences, and I'll understand!";
    }
}

function addMessage(sender, message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender.toLowerCase()}`;
    messageDiv.textContent = message;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Add enter key support
userInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});