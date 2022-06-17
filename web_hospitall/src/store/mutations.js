export default {
    setadmin(state, data) {
        state.admin = data
    },
    setuser(state, data) {
        state.user = data
    },
    setuserLoad(state, data) {
        state.User_load = data
    },
    setBook(state, data) {
        state.book = data
    },
    setModal(state, data) {
        state.modal = data;
    },
    setModalUser(state, data) {
        state.modalUser = data;
    },
    setKeyChat(state, data) {
        state.keyChat = data;
    }
}