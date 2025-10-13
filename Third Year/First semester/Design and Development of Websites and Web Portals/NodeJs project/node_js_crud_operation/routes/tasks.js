const express = require('express');
const router = express.Router();
const dbConn = require('../lib/db');

// Display tasks page
router.get('/', function (req, res, next) {
    dbConn.query('SELECT * FROM tasks ORDER BY id_task DESC', function (err, rows) {
        if (err) {
            req.flash('error', err);
            res.render('tasks/index', { data: '' });
        } else {
            res.render('tasks/index', { data: rows });
        }
    });
});

// Display add task page
router.get('/add', function (req, res, next) {
    res.render('tasks/add', {
        title: '',
        description: '',
        priority: 'Low' // Default priority
    });
});

// Add a new task
router.post('/add', function (req, res, next) {
    let title = req.body.title;
    let description = req.body.description;
    let priority = req.body.priority;
    let errors = false;

    if (title.length === 0 || description.length === 0) {
        errors = true;
        req.flash('error', 'Please enter title and description');
        res.render('tasks/add', {
            title,
            description,
            priority
        });
    }

    if (!errors) {
        let form_data = { title, description, priority, status: 'in progress' };
        dbConn.query('INSERT INTO tasks SET ?', form_data, function (err, result) {
            if (err) {
                req.flash('error', err);
                res.render('tasks/add', {
                    title,
                    description,
                    priority
                });
            } else {
                req.flash('success', 'Task successfully added');
                res.redirect('/tasks');
            }
        });
    }
});

// Display edit task page
router.get('/edit/:id', function (req, res, next) {
    let id = req.params.id;
    dbConn.query('SELECT * FROM tasks WHERE id_task = ?', [id], function (err, rows) {
        if (err) {
            req.flash('error', err);
            res.redirect('/tasks');
        } else if (rows.length <= 0) {
            req.flash('error', 'Task not found with id_task = ' + id);
            res.redirect('/tasks');
        } else {
            res.render('tasks/edit', {
                id_task: rows[0].id_task,
                title: rows[0].title,
                description: rows[0].description,
                priority: rows[0].priority
            });
        }
    });
});

// Update task data
router.post('/update/:id', function (req, res, next) {
    let id = req.params.id;
    let title = req.body.title;
    let description = req.body.description;
    let priority = req.body.priority;
    let errors = false;

    if (title.length === 0 || description.length === 0) {
        errors = true;
        req.flash('error', 'Please enter title and description');
        res.render('tasks/edit', {
            id_task: id,
            title,
            description,
            priority
        });
    }

    if (!errors) {
        let form_data = { title, description, priority };
        dbConn.query('UPDATE tasks SET ? WHERE id_task = ?', [form_data, id], function (err, result) {
            if (err) {
                req.flash('error', err);
                res.render('tasks/edit', {
                    id_task: id,
                    title,
                    description,
                    priority
                });
            } else {
                req.flash('success', 'Task successfully updated');
                res.redirect('/tasks');
            }
        });
    }
});

// Delete task
router.get('/delete/:id', function (req, res, next) {
    let id = req.params.id;
    dbConn.query('DELETE FROM tasks WHERE id_task = ?', [id], function (err, result) {
        if (err) {
            req.flash('error', err);
            res.redirect('/tasks');
        } else {
            req.flash('success', 'Task successfully deleted! ID = ' + id);
            res.redirect('/tasks');
        }
    });
});

// Search tasks
router.get('/search', function (req, res, next) {
    let query = req.query.query;
    dbConn.query(
        'SELECT * FROM tasks WHERE title LIKE ? OR description LIKE ? ORDER BY id_task DESC',
        [`%${query}%`, `%${query}%`],
        function (err, rows) {
            if (err) {
                req.flash('error', err);
                res.redirect('/tasks');
            } else {
                res.render('tasks/index', { data: rows });
            }
        }
    );
});

// Mark task as complete
router.get('/complete/:id', (req, res, next) => {
    let id = req.params.id;
    dbConn.query('UPDATE tasks SET status = ? WHERE id_task = ?', ['complete', id], (err, result) => {
        if (err) {
            req.flash('error', err);
            res.redirect('/tasks');
        } else {
            req.flash('success', 'Task marked as complete!');
            res.redirect('/tasks');
        }
    });
});

// Display completed tasks page
router.get('/completed', function (req, res, next) {
    dbConn.query('SELECT * FROM tasks WHERE status = "complete"', function (err, rows) {
        if (err) {
            req.flash('error', err);
            res.render('tasks/completed', { data: [] });
        } else {
            res.render('tasks/completed', { data: rows });
        }
    });
});

module.exports = router;
