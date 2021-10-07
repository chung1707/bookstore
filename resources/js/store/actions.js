const axios = require('axios');

export default {
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
        axios.post("/update_qty_cart", { 'book_id': book.id, newQuanty: book.pivot.quantity }).then (() =>{
        });
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
    },
    removeBook(context, book){
        context.commit('removeImportBook',book);
    },
    import(context,equipments_import){
        let equipments = equipments_import[0];
        let bill = equipments_import;
        equipments.forEach(equipment => equipment.supplier_id = equipments_import[1]);
        axios.post('/equipment',{'equipments': equipments, 'bill': bill}).then((response) =>{
            if(response.data.status == 201){
                context.commit('setBookImport',[]);
            }
        });
    },
}
