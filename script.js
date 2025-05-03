document.addEventListener("DOMContentLoaded", function () {
  const taskForm = document.getElementById("task-form");
  const taskInput = document.getElementById("task");
  const taskList = document.getElementById("task-list");

  function loadTasks() {
    fetch("../backend/fetch_tasks.php")
      .then((response) => response.json())
      .then((data) => {
        taskList.innerHTML = "";
        data.forEach((task) => {
          const li = document.createElement("li");
          li.textContent = task.name;
          taskList.appendChild(li);
        });
      });
  }

  taskForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const task = taskInput.value.trim();
    if (!task) return;

    fetch("../backend/submit_task.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ task }),
    }).then(() => {
      taskInput.value = "";
      loadTasks();
    });
  });

  loadTasks();
});
