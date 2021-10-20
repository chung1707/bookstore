const axios = require('axios');

export default {
    //user cart
    getListBook(context){
        axios.get("/get_cart").then(response =>{
            context.commit('setBooks',response.data.books);
        });
    },
    addToCart(context,book){
        axios.post("/add-to-cart",{'book_id': book.id,'quantity': book.with.quantity}).then(()=> {
            context.commit('addToCart',book);
        });
    },
    deleteBookInCart(context,book){
        axios.post("/delete_book_in_cart",{'book_id': book.id});
        context.commit('deleteBook',book);
    },
    updateQty(context,book){
        axios.post("/update_qty_cart", { 'book_id': book.id, newQuanty: book.pivot.quantity });
    },


    setAuthUser(context,user){
        context.commit('setAuthUser',user);
    },
    getAdmins(context){
        axios.get('/admin/get_admin_accounts').then( response => {
            context.commit('setAdmins',response.data.adminAccounts);
        });
    },
    getUsers(context,page){
        axios.get('/admin/get_user_accounts?page='+page).then( response => {
            context.commit('setUsers',response.data.users);
            total_page = response.data.users.links;
            context.commit('setTotalPage',response.data.users.links);
        });
    },
    // load file avartar
    setThumbnails(context, thumbnails){
        context.commit('setThumbnailNames',thumbnails);
    },

    //import
    addBook(context, book){
        context.commit('addBookImport',book);
        context.commit('setThumbnailNames',[]);
        context.commit('setCategory_ids',[]);
    },
    removeBook(context, book){
        context.commit('removeImportBook',book);
    },
    import(context,books_import){
        let books = books_import[0];
        let bill = books_import;
        books.forEach(book => book.supplier_id = books_import[1]);
        axios.post('/admin/book',{'books': books, 'bill': bill}).then((response) =>{
            if(response.data.status == 201){
                context.commit('setBookImport',[]);
            }
        });
    },
    // categories selector
    setCategory_ids(context,category_ids){
        context.commit('setCategory_ids',category_ids);
    },
    //checkout
    setPostage(context,postage){
        context.commit('setPostage',postage);
    },
    clearCart(context){
        axios.post('/clearCart');
        context.commit('setBooks',[]);
    },
    // admin cart
    getAdminCart(context){
        axios.get("/admin/get_cart").then(response =>{
            context.commit('setAdminCart',response.data.books);
        });
    },
    addToAdminCart(context,book){
        axios.post("/admin/add-to-cart",{'book_id': book.id}).then(()=> {
            context.commit('addToAdminCart',book);
        });
    },
    deleteBookInAdminCart(context,book){
        axios.post("/admin/delete_book_in_cart",{'book_id': book.id});
        context.commit('deleteBookInAdminCart',book);
    },
    updateQtyAdminCart(context,book){
        axios.post("/admin/update_qty_cart", { 'book_id': book.id, newQuanty: book.pivot.quantity });
    },
    clearCart(context){
        axios.post('/admin/clearCart');
        context.commit('setAdminCart',[]);
    },
}
