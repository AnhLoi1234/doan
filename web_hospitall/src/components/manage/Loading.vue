<template>
    <div class="loading">
        <div class="loader"></div>
    </div>
</template>

<style scoped>
.loading {
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: fixed;
    background-color: rgba(226, 158, 249, 0.29);
    display: flex;
    align-items: center;
    animation: unset !important;
    justify-content: center;
    z-index: 999;
}

.loader {
    border: 8px solid rgb(154, 137, 150);
    width: 100px;
    height: 100px;
    position: absolute;
    animation: 1s loader-02 linear infinite;
    border-radius: 50%;
    border-left-color: transparent;
    border-right-color: transparent;
}

.loader:before,
.loader:after {
    display: none;
}

@keyframes loader-02 {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>