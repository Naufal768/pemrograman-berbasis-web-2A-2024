const taskNotification = document.querySelector("[task-notification]");
const finishNotification = document.querySelector("[finish-notification]");
const listContainer = document.querySelector("[list-container]");
const input = document.querySelector("[input-list]");
const inputSubmit = document.querySelector("[input-submit]");

const KEY = "TODOLIST";
let storeData = [];

inputSubmit.addEventListener("click", () => {
    storeData.push({
        id: Date.now(),
        text: input.value,
        finish: false
    });
    input.value = "";
    saveData();
    render();
});

function render() {
  removeListElement();

  let finish = 0;
  let task = 0;
  storeData.forEach((data) => {
      if (data.text !== "") {
          data.finish ? finish++ : task++;

          const listItem = document.createElement("div");
          const text = document.createElement("div");
          const iconDelete = document.createElement("i");
          const iconEdit = document.createElement("i");
          const checkbox = document.createElement("input");

          iconDelete.onclick = () => deleteTask(data.id);
          iconEdit.onclick = () => editTask(data.id);
          checkbox.type = "checkbox";
          checkbox.checked = data.finish;

          listItem.className = "list-item";
          text.className = "list-text";
          text.innerHTML = data.text;
          iconDelete.className = "fas fa-trash-alt delete-list";
          iconEdit.className = "fas fa-edit edit-list";

          listItem.appendChild(checkbox);
          listItem.appendChild(text);
          listItem.appendChild(iconDelete);
          listItem.appendChild(iconEdit);
          listContainer.appendChild(listItem);

          checkbox.addEventListener("change", () => {
              data.finish = checkbox.checked;
              saveData();
              render();
          });
      }
  });

  finishNotification.innerHTML = `Finish ${finish}`;
  taskNotification.innerHTML = `Tasks ${task}`;
}

function removeListElement() {
    while (listContainer.hasChildNodes()) {
        listContainer.removeChild(listContainer.firstChild);
    }
}

function deleteTask(id) {
  storeData = storeData.filter(data => data.id !== id);
  saveData();
  render();
}

function editTask(id) {
  const newText = prompt("Edit task:");
  if (newText !== null && newText !== "") {
    const taskIndex = storeData.findIndex(data => data.id === id);
    storeData[taskIndex].text = newText;
    saveData();
    render();
  }
}

function saveData() {
  localStorage.setItem(KEY,JSON.stringify(storeData));
  render();
}

function loadData() {
  const data = JSON.parse(localStorage.getItem(KEY));
  if (data !== null) {
    storeData = data;
    render();
  }
}

loadData();