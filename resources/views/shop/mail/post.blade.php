<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post View</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      padding: 20px;
      text-align: center;
    }

    h1 {
      font-size: 24px;
      color: #007BFF;
      margin-bottom: 20px;
    }

    .title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .description {
      font-size: 16px;
      line-height: 1.5;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Hey there is a new post</h1>
    <div class="title">{{$title_en}}</div>
    <div class="description">{{$description_en}}</div>
    <br>
    <h1>هناك خبر جديد</h1>
    <div class="title">{{$title_ar}}</div>
    <div class="description">{{$description_ar}}</div>
    <div class="description">{{$post->created_at}}</div>

    <div>
        if you don't want to receive this kind of emails,you can update<br>
        your can <a href="{{$unsubscribeUrl}}" style="color: black;text-decoration: underline;">unsbscribe from this type of email.</a>
    </div>
  </div>
</body>
</html>
