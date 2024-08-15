var mysql = require('mysql');
var { Server } = require('socket.io');
var http = require('http');

// Crea un servidor HTTP
var server = http.createServer();
var io = new Server(server);

server.listen(8000, function() {
    console.log('Servidor escuchando en el puerto 8000');
});

var usuariosOnline = {};

io.on('connection', function(client) {
    client.join('salaTurnos');

    client.on('message', function(event) {
        console.log('Mensaje recibido del cliente! ', event);
        client.send(event);
    });

    client.on('tur_cc', function(data) {
        client.to('salaTurnos').emit('PANTALLATV_CC', data);
    });

    client.on('tur_lb', function(data) {
        client.to('salaTurnos').emit('PANTALLATV_LB', data);
    });

    client.on('disconnect', function() {
        if (typeof(client.userid) === "undefined") {
            console.log('Usuario no logueado en el sistema de turnos');
            return;
        }

        var ultimo = usuariosOnline[client.userid];
        delete usuariosOnline[client.userid];
        console.log('Un usuario ha salido del sistema de turnos ' + client.userid);
        client.broadcast.emit("MostrarUsuarios", usuariosOnline);
        var datos = ultimo.split('|');

        var connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: 'admin',
            database: datos[4] == 1 ? 'tur_cc' : 'tur_lb'
        });

        connection.connect();

        connection.query("UPDATE MODULOS SET MODUESTA=0, MODUUSUA='', MODUSERV='', MODUMULT='' WHERE MODUUSUA = ?", [client.userid], function(err) {
            if (err) {
                console.log("Error: " + err.message);
                throw err;
            } else {
                console.log("Reset modulos correctamente");
            }
        });

        connection.query("UPDATE USUARIOS SET USUAESTA = 0 WHERE USUAID = ?", [client.userid], function(err) {
            if (err) {
                console.log("Error: " + err.message);
                throw err;
            } else {
                console.log("Reset usuario correctamente");
            }
        });

        connection.end();
    });

    client.on("UsuariosLogueados", function(userid) {
        var datos = userid.split('|');
        userid = datos[0];
        console.log('Usuario conectado de código: ' + userid);

        if (usuariosOnline[userid]) {
            client.emit("userInUse");
            return;
        }

        client.userid = userid;
        usuariosOnline[userid] = datos[0] + '|' + datos[1] + '|' + datos[2] + '|' + datos[3] + '|' + datos[5];

        client.broadcast.emit("MostrarUsuarios", usuariosOnline);
        client.emit("MostrarUsuarios", usuariosOnline);

        var connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: 'admin',
            database: datos[5] == 1 ? 'tur_cc' : 'tur_lb'
        });

        connection.connect();

        connection.query("UPDATE MODULOS SET MODUESTA=1, MODUUSUA=?, MODUSERV=?, MODUMULT=? WHERE MODUID = ?", [client.userid, datos[4], datos[5], datos[2]], function(err) {
            if (err) {
                console.log("Error: " + err.message);
                throw err;
            } else {
                console.log("Actualización de modulos por acción navegador");
            }
        });

        connection.query("UPDATE USUARIOS SET USUAESTA=1 WHERE USUAID = ?", [client.userid], function(err) {
            if (err) {
                console.log("Error: " + err.message);
                throw err;
            } else {
                console.log("Actualización de usuarios por acción navegador");
            }
        });

        connection.end();
    });
});
