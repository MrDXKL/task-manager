document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("taskInput");
    const addTaskBtn = document.getElementById("addTaskBtn");
    const taskList = document.getElementById("taskList");

    addTaskBtn.addEventListener("click", function () {
        const task = taskInput.value.trim();
        if (task === "") return;

        fetch("./submit_task.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `task=${encodeURIComponent(task)}`,
        })
        .then(response => {
            if (!response.ok) throw new Error("Task submit failed");
            return response.text();
        })
        .then(() => {
            taskInput.value = "";
            loadTasks();
        })
        .catch(error => console.error("Error:", error));
    });

    function loadTasks() {
        fetch("./fetch_tasks.php")
            .then(response => {
                if (!response.ok) throw new Error("Task fetch failed");
                return response.json();
            })
            .then(tasks => {
                taskList.innerHTML = "";
                tasks.forEach(task => {
                    const li = document.createElement("li");
                    li.textContent = task.name;
                    taskList.appendChild(li);
                });
            })
            .catch(error => console.error("Error:", error));
    }

    loadTasks();
});
