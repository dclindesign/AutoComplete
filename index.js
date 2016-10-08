var bby = require('bestbuy')('tbfysysru7tnt8cs2ja2zec7');

var search = bby.products('name=' + process.argv[2], {
    show: 'name'
});

search.then(processData);

function processData(data) {
    if (!data.total) {
        console.log('No products found.');
    } else {

        for (i = 0; i < data.total; i++) {
            if (data.products[i] === undefined) {
                break;
            } else {
                var product = data.products[i];
                console.log('total' + data.total);
                console.log('Name:' + product.name);
            }
        }
    }
}
