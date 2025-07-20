document.addEventListener("DOMContentLoaded", () => {
  const todoList = document.getElementById("todo-list");
  const todoInput = document.getElementById("todo-input");
  const addBtn = document.getElementById("addBtn");

  // Load tasks on page load
  fetch("get-tasks.php")
    .then(res => res.json())
    .then(tasks => {
      tasks.forEach(task => {
        addTaskToDOM(task.id, task.content);
      });
    });

  // Add task
  addBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const content = todoInput.value.trim();
    if (content === "") return;

    fetch("add-task.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ content }),
    })
      .then(res => res.json())
      .then(task => {
        addTaskToDOM(task.id, task.content);
        todoInput.value = "";
      });
  });

  // Delete task
  todoList.addEventListener("click", (e) => {
    if (e.target.closest("button")?.classList.contains("deleteBtn")) {
      const li = e.target.closest("li");
      const taskId = li.dataset.id;

      fetch("delete-task.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ id: taskId }),
      })
        .then(res => res.json())
        .then(() => {
          li.remove();
        });
    }
  });

  function addTaskToDOM(id, text) {
    const li = document.createElement("li");
    li.className = "todo";
    li.dataset.id = id;
    li.innerHTML = `
      <input type="checkbox" id="todo-${id}">
      <label class="custom-checkbox" for="todo-${id}">
        <svg fill="transparent" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
          <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
        </svg>
      </label>
      <label for="todo-${id}" class="todo-text">${text}</label>
      <button class="deleteBtn">
        <svg fill="var(--secondary-color)" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
          <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
        </svg>
      </button>
    `;
    todoList.appendChild(li);
  }
});
