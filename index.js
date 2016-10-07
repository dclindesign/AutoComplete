var bby = require('bestbuy')('tbfysysru7tnt8cs2ja2zec7');
bby.products('name=' + process.argv[2], {
    show: 'name'
}).then(function(data) {
    console.log('name:', data.name);
});
