
<nav class="nav">
    <div class='logo'>
        <img src="/API/images/logo.png" alt="Kumpares" />
        <a href="http://localhost/Management/">KUMPARES</a>
    </div>
    <ul class="links">
        <li><a 
            <?php 
        
            if($_SERVER['SCRIPT_NAME'] == "/Management/queuing.php") { ?>
                class="active"
                <?php } ?>
            href="./queuing.php"><i class="fas fa-list-ol"></i>QUEING</a></li>
        <li ><a
            <?php 
            echo $_SERVER['SCRIPT_NAME'];
            if($_SERVER['SCRIPT_NAME'] == "/Management/management.php") { ?>
                class="active"
                <?php } ?>
             href="./management.php"><i class="fas fa-edit"></i>MANAGEMENT</a></li>
        <li><a 
            <?php 
            echo $_SERVER['SCRIPT_NAME'];
            if($_SERVER['SCRIPT_NAME'] == "/Management/transactions.php") { ?>
                class="active"
                <?php } ?>
            href="./transactions.php"><i class="fas fa-history"></i>TRANSACTIONS</a></li>
        <li><a 
            <?php 
            echo $_SERVER['SCRIPT_NAME'];
            if($_SERVER['SCRIPT_NAME'] == "/Management/report.php") { ?>
                class="active"
                <?php } ?>
            href="./report.php"><i class="fas fa-file-alt"></i>REPORT</a></li>
        <li><a href="javascript:logout();"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>      
    </ul>
</nav>

<div class="overlay" id="dialog-container">
    <div class="popup">
      <p class="popup_title"></p>
      <div class="text-center">
        <button class="dialog-btn btn-cancel" id="cancel">CANCEL</button>
        <button class="dialog-btn btn-primary" id="confirm">OK</button>
      </div>
    </div>
</div>

<script>
    function logout() {      
        var overlayme = document.getElementById("dialog-container");
  var title = document.querySelector(".popup_title");

  title.innerHTML = "Are you sure to logout?";

  overlayme.onclick = function () {
    overlayme.style.display = "none";
  };

  /* A function to show the dialog window */
  if (overlayme.style.display === "none") {
    overlayme.style.display = "block";
  } else {
    overlayme.style.display = "none";
  }

   // If confirm btn is clicked , the function confim() is executed
   document.getElementById("confirm").onclick = function () {
    $.ajax({
        type: "POST",
        url: "./logout.php",
        data: null,
        success: function () {
            window.location.reload(1);
        }
    });
    overlayme.style.display = "none";
  };

  // If cancel btn is clicked , the function cancel() is executed
  document.getElementById("cancel").onclick = function () {
    overlayme.style.display = "none";
  };
 
    }
 </script>