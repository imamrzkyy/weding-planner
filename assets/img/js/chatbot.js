document.addEventListener("DOMContentLoaded", function(){

const chatBubble = document.getElementById("chatBubble");
const chatContainer = document.getElementById("chatContainer");
const chatForm = document.getElementById("chatForm");
const chatInput = document.getElementById("chatInput");
const chatMessages = document.getElementById("chatMessages");

if(chatBubble){
chatBubble.addEventListener("click", () => {
  if(chatContainer.style.display === "flex"){
    chatContainer.style.display = "none";
  } else {
    chatContainer.style.display = "flex";
  }
});

chatClose.addEventListener("click", () => {
  chatContainer.classList.remove("active");
});

}

if(chatForm){
chatForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const msg = chatInput.value.trim();
  if(!msg) return;

  // pesan user
  const userMsg = document.createElement("div");
  userMsg.textContent = "Anda: " + msg;
  userMsg.classList.add("user-message");
  chatMessages.appendChild(userMsg);

  chatInput.value = "";

  try{

  const response = await fetch("chat.php",{
    method:"POST",
    headers:{
      "Content-Type":"application/x-www-form-urlencoded"
    },
    body:"message="+encodeURIComponent(msg)
  });

  const answer = await response.text();

  const aiMsg = document.createElement("div");
  aiMsg.textContent = "AI: " + answer;
  aiMsg.classList.add("ai-message");
  chatMessages.appendChild(aiMsg);

  chatMessages.scrollTop = chatMessages.scrollHeight;

  }catch(err){
    console.error(err);
  }

});
}

});