 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-darkk">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SystemLogoHolder</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="aboutus.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="contactus.php">Contact Us</a>
          </li>
          <li class="nav-item pl-3">
          <p id="demo" style="color:white; font-size:3vh; padding:0%; margin:0%; padding-left:2vh;padding-right:2vh;"></p>
          </li>
		  <?php 
			if(isset($_SESSION['isAdmin'])) {
				?>
		      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Maintain DB
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./Forms/chose_Table_for_insert.php">Insert</a></li>
              <li><a class="dropdown-item" href="./Forms/update.php">Update</a></li>
              <li><a class="dropdown-item" href="./Forms/delete.php">Delete</a></li>
              <li><a class="dropdown-item" href="./map.php">Select</a></li>
            </ul>
          </li>
		  <?php
			}?>
        </ul>
        <form class="d-flex" method="GET">
          <input class="form-control me-2" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
		<?php
		if (isset($_SESSION['loggedin'])) {
			?>
			<ul class="nav navbar-nav navbar-right light">
            <li><a href="#"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.60464 11.4417C5.79269 13.1343 5.88672 13.9805 6.45624 14.4903C7.02576 15 7.87723 15 9.58017 15H9.70588H13.4706H14.827C16.0002 15 16.5867 15 17.0627 14.7134C17.5387 14.4268 17.8132 13.9084 18.3621 12.8716L20.8303 8.20947C21.361 7.207 20.6343 6 19.5 6V6H9.70588H9.46906C7.38336 6 6.34051 6 5.74427 6.66616C5.14803 7.33231 5.2632 8.36878 5.49353 10.4417L5.60464 11.4417Z" stroke="#f2f2f2" stroke-width="1" stroke-linejoin="round"></path> <path d="M3 3H3.5V3C4.1642 3 4.72218 3.49942 4.79553 4.15955L5.55558 11" stroke="#f2f2f2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18C8.32843 18 9 18.6716 9 19.5Z" stroke="#f2f2f2" stroke-width="1"></path> <path d="M18 19.5C18 20.3284 17.3284 21 16.5 21C15.6716 21 15 20.3284 15 19.5C15 18.6716 15.6716 18 16.5 18C17.3284 18 18 18.6716 18 19.5Z" stroke="#f2f2f2" stroke-width="1"></path> </g></svg></a></li>
            <li><a href="DB_Operations/logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
  <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
  <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
</svg></a></li>
			</ul>
		<?php 
		}
		else
		{
		?>
        <ul class="nav navbar-nav navbar-right light">
            <li><a href="#"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.60464 11.4417C5.79269 13.1343 5.88672 13.9805 6.45624 14.4903C7.02576 15 7.87723 15 9.58017 15H9.70588H13.4706H14.827C16.0002 15 16.5867 15 17.0627 14.7134C17.5387 14.4268 17.8132 13.9084 18.3621 12.8716L20.8303 8.20947C21.361 7.207 20.6343 6 19.5 6V6H9.70588H9.46906C7.38336 6 6.34051 6 5.74427 6.66616C5.14803 7.33231 5.2632 8.36878 5.49353 10.4417L5.60464 11.4417Z" stroke="#f2f2f2" stroke-width="1" stroke-linejoin="round"></path> <path d="M3 3H3.5V3C4.1642 3 4.72218 3.49942 4.79553 4.15955L5.55558 11" stroke="#f2f2f2" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18C8.32843 18 9 18.6716 9 19.5Z" stroke="#f2f2f2" stroke-width="1"></path> <path d="M18 19.5C18 20.3284 17.3284 21 16.5 21C15.6716 21 15 20.3284 15 19.5C15 18.6716 15.6716 18 16.5 18C17.3284 18 18 18.6716 18 19.5Z" stroke="#f2f2f2" stroke-width="1"></path> </g></svg></a></li>
            <li><a href="login.html"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 20.7499H6C5.65324 20.7647 5.30697 20.7109 4.98101 20.5917C4.65505 20.4725 4.3558 20.2902 4.10038 20.0552C3.84495 19.8202 3.63837 19.5371 3.49246 19.2222C3.34654 18.9073 3.26415 18.5667 3.25 18.2199V5.77994C3.26415 5.43316 3.34654 5.09256 3.49246 4.77765C3.63837 4.46274 3.84495 4.17969 4.10038 3.9447C4.3558 3.70971 4.65505 3.52739 4.98101 3.40818C5.30697 3.28896 5.65324 3.23519 6 3.24994H9C9.19891 3.24994 9.38968 3.32896 9.53033 3.46961C9.67098 3.61027 9.75 3.80103 9.75 3.99994C9.75 4.19886 9.67098 4.38962 9.53033 4.53027C9.38968 4.67093 9.19891 4.74994 9 4.74994H6C5.70307 4.72412 5.4076 4.81359 5.17487 4.99977C4.94213 5.18596 4.78999 5.45459 4.75 5.74994V18.2199C4.78999 18.5153 4.94213 18.7839 5.17487 18.9701C5.4076 19.1563 5.70307 19.2458 6 19.2199H9C9.19891 19.2199 9.38968 19.299 9.53033 19.4396C9.67098 19.5803 9.75 19.771 9.75 19.9699C9.75 20.1689 9.67098 20.3596 9.53033 20.5003C9.38968 20.6409 9.19891 20.7199 9 20.7199V20.7499Z" fill="#f2f2f2"></path> <path d="M16 16.7499C15.9015 16.7504 15.8038 16.7312 15.7128 16.6934C15.6218 16.6556 15.5392 16.6 15.47 16.5299C15.3296 16.3893 15.2507 16.1987 15.2507 15.9999C15.2507 15.8012 15.3296 15.6105 15.47 15.4699L18.94 11.9999L15.47 8.52991C15.3963 8.46125 15.3372 8.37845 15.2962 8.28645C15.2552 8.19445 15.2332 8.09513 15.2314 7.99443C15.2296 7.89373 15.2482 7.7937 15.2859 7.70031C15.3236 7.60692 15.3797 7.52209 15.451 7.45087C15.5222 7.37965 15.607 7.32351 15.7004 7.28579C15.7938 7.24807 15.8938 7.22954 15.9945 7.23132C16.0952 7.23309 16.1945 7.25514 16.2865 7.29613C16.3785 7.33712 16.4613 7.39622 16.53 7.46991L20.53 11.4699C20.6705 11.6105 20.7493 11.8012 20.7493 11.9999C20.7493 12.1987 20.6705 12.3893 20.53 12.5299L16.53 16.5299C16.4608 16.6 16.3782 16.6556 16.2872 16.6934C16.1962 16.7312 16.0985 16.7504 16 16.7499Z" fill="#f2f2f2"></path> <path d="M20 12.75H9C8.80109 12.75 8.61032 12.671 8.46967 12.5303C8.32902 12.3897 8.25 12.1989 8.25 12C8.25 11.8011 8.32902 11.6103 8.46967 11.4697C8.61032 11.329 8.80109 11.25 9 11.25H20C20.1989 11.25 20.3897 11.329 20.5303 11.4697C20.671 11.6103 20.75 11.8011 20.75 12C20.75 12.1989 20.671 12.3897 20.5303 12.5303C20.3897 12.671 20.1989 12.75 20 12.75Z" fill="#f2f2f2"></path> </g></svg></a></li>
        </ul>
		<?php }?>
      </div>
    </div>
  </nav>
		