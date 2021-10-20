export default {
    books(state){
        return state.books;
    },
    totalPrice(state){
        let sum = null;
            for (var i = 0; i < state.books.length; i++) {
                sum +=
                    state.books[i].price *
                    state.books[i].pivot.quantity *
                    ((100 - state.books[i].discount )/ 100);
            }
        return sum *((100-state.discountCode) /100 ) + state.postage;
    },
    totalBook(state){
        let total = 0;
        for(let i = 0; i < state.books.length; i++){
            total += Number(state.books[i].pivot.quantity);
        }
        return Number(total);
    },
    discountCode(state){
        return state.discountCode ;
    },
    authUser(state){
        return state.authUser;
    },
    thumbnails(state){
        return state.thumbnails;
    },
    importBooks(state){
        return state.importBooks;
    },
    //categories selector
    category_ids(state){
        return state.category_ids;
    },
    sumPrice(state){
        let total = 0;
        for(let i = 0; i < state.importBooks.length; i++){
            total += state.importBooks[i].quantity * state.importBooks[i].price;
        }
        return total;
    },
    //admin cart
    adminCart(state){
        return state.adminCart;
    },
    adminCartTotalPrice(state){
        let sum = null;
            for (var i = 0; i < state.adminCart.length; i++) {
                sum +=
                    state.adminCart[i].price *
                    state.adminCart[i].pivot.quantity *
                    ((100 - state.adminCart[i].discount )/ 100);
            }
        return sum;
    },
    totalBookInAdminCart(state){
        let total = 0;
        for(let i = 0; i < state.adminCart.length; i++){
            total += Number(state.adminCart[i].pivot.quantity);
        }
        return Number(total);
    },
}
