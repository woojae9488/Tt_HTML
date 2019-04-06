module.export = {
    fs: require('fs'),
    url: require('url'),
    qs: require('querystring'),
    template: require('./template'),
    create: function () {
        fs.readdir('./Data/', function (error, fileList) {
            title = 'WEB - Create';
            var list = template.list(fileList);
            var html = template.html(title, list,
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
            response.end(html);
        })
    },
    create_process: function () {
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
    },
    update: function () {
        fs.readFile(`Data/${title}`, 'utf-8', function (err, description) {
            fs.readdir('./Data/', function (error, fileList) {
                var list = template.list(fileList);
                var html = template.html(title, list,
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
                response.end(html);
            });
        });
    },
    update_process:function(){
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
    },
    delete_process:function(){
        var body = '';
        request.on('data', function (data) {
          body += data;
        });
        request.on('data', function () {
          var post = qs.parse(body);
          var id = post.id;
          fs.unlink(`Data/${id}`, function (err) {
            response.writeHead(302, { Location: `/` });
            response.end('success');
          });
        });
    },
    not_found:function(){
        response.writeHead(404);
        response.end('Not found');
    }
}
