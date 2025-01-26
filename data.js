const filipinoCuisineData = {
    "dishes": [
        {
            "name": "Sinigang na Isda",
            "description": "Sour fish soup with vegetables",
            "healthBenefits": ["Low in calories", "High in protein", "Rich in vitamins"],
            "suitableFor": ["diabetes", "hypertension", "heart disease"],
            "notSuitableFor": [],
            "alternatives": "Use less salt for hypertensive individuals"
        },
        {
            "name": "Ginisang Munggo",
            "description": "Sautéed mung beans with spinach",
            "healthBenefits": ["High in fiber", "Good protein source", "Low fat"],
            "suitableFor": ["diabetes", "hypertension", "obesity"],
            "notSuitableFor": [],
            "alternatives": "Can be made without pork for lower fat content"
        },
        {
            "name": "Tinolang Manok",
            "description": "Chicken soup with green papaya and ginger",
            "healthBenefits": ["Anti-inflammatory", "Good for immunity", "Low fat"],
            "suitableFor": ["diabetes", "flu", "colds"],
            "notSuitableFor": [],
            "alternatives": "Use chicken breast for lower fat content"
        },
        {
            "name": "Pinakbet",
            "description": "Mixed vegetables with shrimp paste",
            "healthBenefits": ["High in fiber", "Rich in vitamins", "Low calories"],
            "suitableFor": ["diabetes", "obesity", "hypertension"],
            "notSuitableFor": [],
            "alternatives": "Use less bagoong for lower sodium"
        },
        {
            "name": "Nilaga",
            "description": "Boiled meat and vegetables soup",
            "healthBenefits": ["High in protein", "Rich in minerals", "Hydrating"],
            "suitableFor": ["diabetes", "recovery", "anemia"],
            "notSuitableFor": ["gout"],
            "alternatives": "Use lean meat cuts for lower fat"
        }
    ],
    "healthConditions": {
        "diabetes": {
            "recommendations": ["Sinigang na Isda", "Ginisang Munggo", "Pinakbet"],
            "avoidance": ["Sweet desserts", "Rice heavy dishes"],
            "tips": "Choose dishes with low glycemic index vegetables"
        },
        "hypertension": {
            "recommendations": ["Sinigang na Isda", "Ginisang Munggo", "Pinakbet"],
            "avoidance": ["Salty dishes", "Processed foods"],
            "tips": "Request less salt or salty condiments in dishes"
        },
        "heart disease": {
            "recommendations": ["Sinigang na Isda", "Ginisang Munggo"],
            "avoidance": ["Fatty meat dishes", "Fried foods"],
            "tips": "Choose lean proteins and lots of vegetables"
        },
        "obesity": {
            "recommendations": ["Sinigang na Isda", "Pinakbet", "Ginisang Munggo"],
            "avoidance": ["Fried dishes", "Fatty meats"],
            "tips": "Focus on vegetable-based dishes and lean proteins"
        },
        "gout": {
            "recommendations": ["Ginisang Munggo", "Pinakbet"],
            "avoidance": ["Nilaga with beef", "High-purine meats"],
            "tips": "Avoid organ meats and high-purine seafood"
        }
    }
};