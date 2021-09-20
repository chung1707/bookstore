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
        return sum;
    },
    totalBook(state){
        let total = 0;
        for(let i = 0; i < state.books.length; i++){
            total += state.books[i].pivot.quantity;
        }
        return total;
    },
    discountCode(state){
        return state.discountCode ;
    },
    authUser(state){
        return state.authUser;
    },
}
