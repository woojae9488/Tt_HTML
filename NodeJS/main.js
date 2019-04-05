var http = require('http');
var fs = require('fs');
var url = require('url');
var qs = require('querystring');

function templateHTML(title, list, body, control) {
  return `
  <!doctype html>
  <html>

  <head>
    <title>WEB1 - ${title}</title>
    <meta charset="utf-8">
  </head>

  <body>
    <h1><a href="/">WEB</a></h1>
    ${list}
    ${control}
    ${body}
  </body>

  </html>
  `;
}
function templateList(fileList) {
  var list = '<ul>';
  for (var i = 0; i < fileList.length; i++) {
    list += `<li><a href="/?id=${fileList[i]}">${fileList[i]}</a></li>`;
  }
  list += '</ul>';

  return list;
}

var app = http.createServer(function (request, response) {
  var _url = request.url;
  var queryData = url.parse(_url, true).query;
  var pathname = url.parse(_url, true).pathname;
  var title = queryData.id;
  var control = `
  <a href="/create">create</a> <a href="/update?id=${title}">update</a>
  `;
  if (pathname === '/') {
    fs.readFile(`Data/${title}`, 'utf-8', function (err, description) {
      if (title === undefined) {
        title = 'Welcome';
        description = 'Hello, Node.js';
        control = `<a href="/create">create</a>`;
      }
      fs.readdir('./Data/', function (error, fileList) {
        var list = templateList(fileList);
        var template = templateHTML(title, list,
          `<h2>${title}</h2>${description}`, control);
        response.writeHead(200);
        response.end(template);
      });
    });
  } else if (pathname === '/create') {
    fs.readdir('./Data/', function (error, fileList) {
      title = 'WEB - Create';
      var list = templateList(fileList);
      var template = templateHTML(title, list,
        `
        <form action="/create_process" method="post">
          <p><input type="text" name="title" placeholder="title"></p>
          <p>
            <textarea name="description" placeholder="description"></textarea>
          </p>
          <p>
            <input type="submit">
          </p>
        </form>
           `, ' ');
      response.writeHead(200);
      response.end(template);
    });
  } else if (pathname === '/create_process') {
    var body = '';
    request.on('data', function (data) {
      body += data;
    });
    request.on('data', function () {
      var post = qs.parse(body);
      var title = post.title;
      var description = post.description;
      fs.writeFile(`Data/${title}`, description, 'utf8',
        function (err) {
          response.writeHead(302, { Location: `/?id=${title}` });
          response.end('success');
        })
    });
  } else if (pathname === "/update") {
    fs.readFile(`Data/${title}`, 'utf-8', function (err, description) {
      fs.readdir('./Data/', function (error, fileList) {
        var list = templateList(fileList);
        var template = templateHTML(title, list,
          `
          <form action="/update_process" method="post">
            <input type="hidden" name="id" value=${title}>
            <p><input type="text" name="title" placeholder="title" value="${title}"></p>
            <p>
              <textarea name="description" placeholder="description">${description}</textarea>
            </p>
            <p>
              <input type="submit">
            </p>
          </form>
          `, control);
        response.writeHead(200);
        response.end(template);
      });
    });
  } else if (pathname === "/update_process") {
    var body = '';
    request.on('data', function (data) {
      body += data;
    });
    request.on('data', function () {
      var post = qs.parse(body);
      var id = post.id;
      var title = post.title;
      var description = post.description;
      fs.rename(`Data/${id}`, `Data/${title}`, function (error) {
        fs.writeFile(`Data/${title}`, description, 'utf8',
          function (err) {
            response.writeHead(302, { Location: `/?id=${title}` });
            response.end('success');
          });
      });
    });
  } else {
    response.writeHead(404);
    response.end('Not found');
  }
});
app.listen(3000);