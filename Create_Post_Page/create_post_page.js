const insertTitle = document.getElementById("title");
const insertContent = document.getElementById("content");
const form = document.querySelector("form");

form.addEventListener("submit", (event) => {
  event.preventDefault();
  let hasError = false;

  const existingErrors = form.querySelectorAll(".error-message");
  existingErrors.forEach((error) => error.remove());

  if (insertTitle.value.trim() == "") {
    const titleErrorMessage = document.createElement('p');
    titleErrorMessage.textContent = "Pleaser insert a title";
    titleErrorMessage.classList.add("error-message");
    const titleParentElement = insertTitle.parentNode;
    titleParentElement.appendChild(titleErrorMessage);
    hasError = true;
  }
  if (insertContent.value.trim() == "") {
    contentErrorMessage = document.createElement('p');
    contentErrorMessage.textContent = "Please insert some content";
    contentErrorMessage.classList.add("error-message");
    const contentParentElement = insertContent.parentNode;
    contentParentElement.appendChild(contentErrorMessage);
    hasError = true;
  }

  if (!hasError) form.submit();
});
