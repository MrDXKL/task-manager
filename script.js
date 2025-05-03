function addTask() {
  const task = document.getElementById("task").value.trim();
  if (task === "") {
    alert("Please enter a task.");
    return;
  }

  fetch("submit_task.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "task=" + encodeURIComponent(task)
  })
    .then(response => {
      if (!response.ok) {
        throw new Error("HTTP error! status: " + response.status);
      }
      return response.text();
    })
    .then(() => {
      document.getElementById("task").value = "";
      loadTasks(); // Reload tasks after adding a new one
    })
    .catch(error => {
      console.error("Error submitting task:", error);
      alert("Something went wrong while adding the task.");
    });
}

function loadTasks() {
  fetch("fetch_tasks.php")
    .then(response => {
      if (!response.ok) {
        throw new Error("HTTP error! status: " + response.status);
      }
      return response.json();
    })
    .then(data => {
      const taskList = document.getElementById("taskList");
      taskList.innerHTML = "";

      data.forEach(task => {
        const li = document.createElement("li");
        li.textContent = task.name;
        taskList.appendChild(li);
      });
    })
    .catch(error => {
      console.error("Error loading tasks:", error);
    });
}

// Automatically load tasks when the page loads
document.addEventListener("DOMContentLoaded", loadTasks);
