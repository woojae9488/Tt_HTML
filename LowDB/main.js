const shortid = require('shortid');
const low = require('lowdb')
const FileAsync = require('lowdb/adapters/FileAsync')
const adapter = new FileAsync('db.json')
const db = low(adapter).then(
    function (db) {
        db.defaults({ topic: [], author: [] }).write()

        // db.get('author').push({
        //     id: 1,
        //     name: 'egoing',
        //     profile: 'developer'
        // }).write()
        // db.get('topic').push({
        //     id: 1,
        //     title: 'lowdb',
        //     description: 'lowdb is ...',
        //     author: 1
        // }).write()
        // db.get('topic').push({
        //     id: 2,
        //     title: 'mysql',
        //     description: 'mysql is ...',
        //     author: 1
        // }).write()

        // console.log(db.get('topic').find({title:'lowdb'}).value())

        // db.get('topic').find({ id: 2 }).assign({ title: 'MySQL & MariaDB'}).write()

        // db.get('topic').remove({ id: 2 }).write()

        var sid = shortid.generate();
        db.get('author').push({
            id: sid,
            name: 'duru',
            profile: 'DB admin'
        }).write().then(function (){
            console.log('add author');
        })

        db.get('topic').push({
            id: shortid.generate(),
            name: 'MSSQL',
            description: 'MSSQL is ...',
            author: sid
        }).write().then(function (){
            console.log('add topic');
        })
    }
)

