const insertName = document.getElementById("username");
const form = document.querySelector("form");
const navbarItems = document.querySelectorAll("p");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  const existingError = document.querySelector(".error-message");
  if (existingError) {
    existingError.remove();
  }

  if (insertName.value.trim() == "") {
    displayErrorMessage();
  } else form.submit();
});

navbarItems.forEach((item) =>
  item.addEventListener("click", (event) => {
    displayErrorMessage();
  })
);

function displayErrorMessage() {
  const existingErrors = form.querySelectorAll(".error-message");
  existingErrors.forEach((error) => error.remove());
  const errorMessage = document.createElement("p");
  errorMessage.textContent = "Please choose a name";
  errorMessage.classList.add("error-message");
  const parentElement = insertName.parentNode;
  parentElement.appendChild(errorMessage);
}
