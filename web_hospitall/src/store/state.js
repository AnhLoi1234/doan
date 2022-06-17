import socketIOClient from "socket.io-client";

export default {
    admin: null,
    user: null,
    HtmlFeature: {
        sideBar: {
            button: '',
            content: '',
        },
    },
    User_load: false,
    book: null,
    modal: {
        data: null,
        loading: true,
        info: null
    },
    modalUser: {
        data: null,
        loading: false
    },
    keyChat: null,
    socket: socketIOClient.connect('http://localhost:4444/')
}