const shoppingDetails = require('./shoppingDetails.js');
const order = require('./order.js');

class orderDetails {
    constructor(shoppingDetails,order){
        this.shoppingDetails = new shoppingDetails(shoppingDetailsData);
        this.order = order;
    }
};

module.exports = orderDetails;