export function initSignup(){

    const signupForm = document.getElementById("signupForm");

    if(!signupForm){
        return;
    };
    
    signupForm.addEventListener("submit", async function (event){
        event.preventDefault();

        const fullName = document.getElementById("fullName").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        const signupMessage = document.getElementById("signupMessage");

        signupMessage.textContent = "";
        signupMessage.classList.remove("show", "success");

        try{

            const response = await fetch("/api/signup", {
                method : "POST",
                headers : {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body : JSON.stringify({
                    fullName : fullName,
                    email : email,
                    password : password
                })
            });

            const data = await response.json();

            if(!response.ok){
                signupMessage.textContent = data.message;
                signupMessage.classList.add("show");

                return;
            }

            signupMessage.textContent = data.message;
            signupMessage.classList.add("show", "success");

            setTimeout(()=>{
                window.location.href = "/login";
            },2000);

        }catch(error){
            signupMessage.textContent = data.textContent;
        }
    });
}