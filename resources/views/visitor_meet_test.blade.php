<html>
<body>

<h2>HTML Forms</h2>

<form action="/visitor_meet" method="post">
    @csrf
  <label for="fname">department:</label><br>
  <input type="text" id="fname" name="depart" value="1"><br>
  {{-- <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br> --}}
  <input type="submit" value="Submit">
</form>

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
