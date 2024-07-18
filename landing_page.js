const insertName = document.getElementById("nameInsert");
const form = document.querySelector("form");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  const existingError = document.querySelector(".error-message");
  if (existingError) {
    existingError.remove();
  }

  if (insertName.value.trim() == "") {
    const errorMessage = document.createElement("p");
    errorMessage.textContent = "Please choose a name";
    errorMessage.classList.add("error-message");
    const parentElement = insertName.parentNode;
    parentElement.appendChild(errorMessage);
  } else form.submit();
});
