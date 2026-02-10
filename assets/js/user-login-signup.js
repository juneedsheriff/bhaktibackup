$(document).ready(function () {

    // ------------------------------
    // OPEN LOGIN MODAL
    // ------------------------------
    $("#openLoginBtn").click(function () {
        $("#authModalLabel").text("Login");
        $("#loginSection").show();
        $("#registerSection").hide();
        $("#authModal").modal("show");
    });

    // ------------------------------
    // OPEN REGISTER MODAL
    // ------------------------------
    $("#openRegisterBtn").click(function () {
        $("#authModalLabel").text("Register");
        $("#loginSection").hide();
        $("#registerSection").show();
        $("#authModal").modal("show");
    });

    // Switch Login → Register
    $("#goRegister").click(function () {
        $("#authModalLabel").text("Register");
        $("#loginSection").hide();
        $("#registerSection").show();
    });

    // Switch Register → Login
    $("#goLogin").click(function () {
        $("#authModalLabel").text("Login");
        $("#registerSection").hide();
        $("#loginSection").show();
    });

    // ------------------------------
    // LOGIN SUBMIT
    // ------------------------------
    $("#loginForm").submit(function (e) {
        e.preventDefault();

        let formData = $(this).serialize() + "&action=login";

        $.ajax({
            url: "module/register.php",
            type: "POST",
            data: formData,
            dataType: "json",

            success: function (res) {

                if (res.status === true) {
                    alert(res.message);

                    $("#loginForm")[0].reset();

                    location.reload();

                } else {
                    alert(res.message);
                }
            },

            error: function () {
                alert("Something went wrong during login.");
            }
        });
    });

    // ------------------------------
    // REGISTER SUBMIT
    // ------------------------------
    $("#registerForm").submit(function (e) {
        e.preventDefault();

        let formData = $(this).serialize() + "&action=register";

        $.ajax({
            url: "module/register.php",
            type: "POST",
            data: formData,
            dataType: "json",

            success: function (res) {
                if (res.status === true) {
                    alert(res.message);

                    // Switch to login after success
                    $("#loginModal").modal("show");

                } else {
                    alert(res.message);
                }
            },

            error: function () {
                alert("Something went wrong during registration.");
            }
        });
    });

    $(document).on("click", "#logoutBtn", function () {
        let formData = $(this).serialize() + "&action=logout";
        $.ajax({
                url: "module/register.php",
                type: "POST",
                data: formData,
                dataType: "json",

                success: function (res) {
                    if (res.status === true) {
                        location.reload();

                    } else {
                        alert(res.message);
                    }
                },

                error: function () {
                    alert("Something went wrong during registration.");
                }
            });
    });


    /* ============================================================
        Helper: Get CSRF Token
    ============================================================ */
    function csrf() {
        return $("#csrf_token").val();
    }


    /* ============================================================
        1. SAVE JOURNAL ENTRY
    ============================================================ */
    $("#saveJournalBtn").click(function () {
        let note = $("#journalText").val().trim();
        let date = $("#journalDate").val().trim();

        if (note === "") {
            alert("Please write something before saving.");
            return;
        }

        $.ajax({
            url: "module/journal_action.php",
            type: "POST",
            data: {
                action: "save",
                note: note,
                date: date,
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    $("#saveJournalForm")[0].reset(); 
                    loadJournals();
                }
                alert(res.message);
            },
            error: function () {
                alert("Error saving journal.");
            }
        });
    });



    /* ============================================================
        2. LOAD JOURNAL LIST
    ============================================================ */
    function loadJournals() {
        $.ajax({
            url: "module/journal_action.php",
            type: "POST",
            data: { 
                action: "list",
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    renderJournalList(res.journals);
                }
            }
        });
    }

    loadJournals();



    /* ============================================================
        3. RENDER JOURNAL HTML
    ============================================================ */
   function renderJournalList(journals) {

    let html = "";

    if (journals.length === 0) {
        html = `<p>No journal entries found.</p>`;
    } else {
        journals.forEach((journal, index) => {

            let num = index + 1;

            html += `
                <div class="journal-item styled-journal">
                
                    <div class="journal-index">${num}</div>

                    <div class="journal-content">
                        <p class="journal-note">${journal.note.replace(/\n/g, "<br>")}</p>
                        <small class="journal-date">${journal.action_date}</small>

                        <div class="journal-actions">
                            <button class="btn btn-sm btn-danger deleteJournalBtn" 
                                data-id="${journal.id}">
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
            `;
        });
    }

    $("#journalSavedList").html(html);
}


    /* ============================================================
        4. DELETE JOURNAL ENTRY
    ============================================================ */
    $(document).on("click", ".deleteJournalBtn", function () {
        let id = $(this).data("id");

        if (!confirm("Delete this journal entry?")) return;

        $.ajax({
            url: "module/journal_action.php",
            type: "POST",
            data: {
                action: "delete",
                journal_id: id,
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                alert(res.message);
                if (res.status) loadJournals();
            }
        });
    });


    $(document).ready(function () {

    /* ============================================================
        1. SAVE GOAL ENTRY
    ============================================================ */
    $("#saveGoalBtn").click(function () {

        let goal = $("#goalInput").val().trim();
     
        let date = $("#goalDate").val().trim();

        if (goal === "") {
            alert("Please enter your goal.");
            return;
        }

        $.ajax({
            url: "module/goal_action.php",
            type: "POST",
            data: {
                action: "save",
                goal: goal,
                date: date,
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    $("#saveGoalForm")[0].reset();
                    loadGoals();
                }
                alert(res.message);
            },
            error: function () {
                alert("Error saving goal.");
            }
        });

    });



    /* ============================================================
        2. LOAD GOAL LIST
    ============================================================ */
    function loadGoals() {
        $.ajax({
            url: "module/goal_action.php",
            type: "POST",
            data: {
                action: "list",
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    renderGoalList(res.goals);
                }
            }
        });
    }

    loadGoals(); // auto load on page ready



    /* ============================================================
        3. RENDER GOALS WITH STYLING
    ============================================================ */
    function renderGoalList(goals) {

        let html = "";

        if (goals.length === 0) {
            html = `<p>No goals saved.</p>`;
        } else {

            goals.forEach((goal, index) => {

                let num = index + 1;

                html += `
                    <div class="goal-item styled-journal">

                        <div class="journal-index">${num}</div>

                        <div class="journal-content">

                            <p class="journal-note">
                                <strong>Goal:</strong> ${goal.goal_text}<br>
                                <strong>Target:</strong> ${goal.target_date ? goal.target_date : "—"}<br>
                            </p>

                            <small class="journal-date">Created on : ${goal.created_at}</small>

                            <div class="journal-actions">
                                <button class="btn btn-sm btn-danger deleteGoalBtn"
                                    data-id="${goal.id}">
                                    Delete
                                </button>
                            </div>

                        </div>

                    </div>
                `;
            });

        }

        $("#goalSavedList").html(html);
    }



    /* ============================================================
        4. DELETE GOAL ENTRY
    ============================================================ */
    $(document).on("click", ".deleteGoalBtn", function () {

        let id = $(this).data("id");

        if (!confirm("Delete this goal?")) return;

        $.ajax({
            url: "module/goal_action.php",
            type: "POST",
            data: {
                action: "delete",
                goal_id: id,
                csrf_token: csrf()
            },
            dataType: "json",
            success: function (res) {
                alert(res.message);
                if (res.status) loadGoals();
            }
        });

    });


});



});


