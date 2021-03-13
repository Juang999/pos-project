<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>login</title>
</head>
<body>
    <center>
        <div class="card mt-5" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Login</h5>
              <form action="/user" method="get"><br>
                @csrf
                  <label for="email">Email</label><br>
                  <input type="email" name="Email" id="email" placeholder="stranger@example.com"><br><br>
                  <label for="password">Password</label><br>
                  <input type="password" name="Password" id="password">
                  <br>
                  <br>
                  <button class="btn btn-primary">login</button>
              </form>
            </div>
          </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>
