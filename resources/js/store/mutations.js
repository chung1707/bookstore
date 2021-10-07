export default {
    setBooks(state, books){
        state.books = books;
    },
    addToCart(state, book){
        let qty  = Number(book.with.quantity);
        let bookInCart = state.books.find(item => {
            return item.id === book.id;
        });
        if(bookInCart){
            if(bookInCart.pivot.quantity + qty > bookInCart.quantity){
                bookInCart.pivot.quantity = bookInCart.quantity;
                return;
            }
            bookInCart.pivot.quantity += qty;
            return;
        }
        book['pivot'] = {'quantity':qty};
        state.books.push(book);
    },
    deleteBook(state,book){
        let index = state.books.indexOf(book);
        state.books.splice(index, 1);
    },
    setAuthUser(state,user){
        state.authUser = user;
    },
    setThumbnailNames(state, thumbnails){
        state.thumbnails = thumbnails;
    },
    addBookImport(state,book){
        state.importBooks.push(book);
    },
    removeImportBook(state,book){
        let index = state.importBooks.indexOf(book);
        state.importBooks.splice(index, 1);
    },
    setBookImport(state, importBooks){
        state.importBooks = importBooks;
    }

}
