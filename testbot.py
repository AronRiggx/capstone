import os
import google.generativeai as genai

GOOGLE_API_KEY = "AIzaSyDouN9hTboS_GZ5MhnIFLurspauBnx86WQ"
genai.configure(api_key=GOOGLE_API_KEY)

# Create the model
generation_config = {
  "temperature": 1,
  "top_p": 0.95,
  "top_k": 40,
  "max_output_tokens": 8192,
  "response_mime_type": "text/plain",
}

model = genai.GenerativeModel(
  model_name="gemini-1.5-flash",
  generation_config=generation_config,
  #write the system instructions here delete the (#)
  #system_instruction=("")
)

chat_session = model.start_chat()

while True:
    user_input = input("You: ")
    if user_input.lower() == {"exit"}:
        print("System name: Goodbye!")
        break
    chat_session.send_message(user_input)
    response_text = chat_session.last.text
    print("System name:", response_text)