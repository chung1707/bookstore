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
    },

    setCategory_ids(state, category_ids){
        state.category_ids = category_ids;
    },
    // checkout
    setPostage(state, postage){
        state.postage = postage;
    },
    setDiscountCode(state, discountCode){
        state.discountCode = discountCode;
    },

    //admin cart
    setAdminCart(state, books){
        state.adminCart = books;
    },
    addToAdminCart(state, book){
        let qty  = 1;
        // tim san pham trong gio hang admin
        let itemIncart = state.adminCart.find(item => {
            return item.id === book.id;
        });
        // san pham da co tron gio
        if(itemIncart){
            if(itemIncart.pivot.quantity + qty > itemIncart.quantity){
                itemIncart.pivot.quantity = itemIncart.quantity;
                return;
            }
            itemIncart.pivot.quantity += qty;
            return;
        }
        //san pham chua co tron gio
        book['pivot'] = {'quantity':qty,'price': null};
        state.adminCart.push(book);
    },
    deleteBookInAdminCart(state,book){
        let index = state.adminCart.indexOf(book);
        state.adminCart.splice(index, 1);
    },
}
