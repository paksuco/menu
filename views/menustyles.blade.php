<style>
    /**
        Taken from example: https://tailwindcomponents.com/component/nestable-dropdown-menu
    */

    .paksuco-menu {
        position: relative;
        z-index: 9999;
    }

    .paksuco-menu>ul>li>ul {
        transform: translatex(0%) scaleY(0);
        position: absolute;
        top: 100%;
        left: 0;
    }

    .paksuco-menu>ul>li:hover>ul {
        transform: translatex(0%) scaleY(1)
    }

    .paksuco-menu li>ul {
        transform-origin: top left;
        transition: transform 100ms ease-in-out;
        transform: translatex(100%) scaleX(0);
        position: absolute;
        top: -1px;
        left: -2px;
    }

    .paksuco-menu li:hover>ul {
        transform: translatex(100%) scaleX(1)
    }

    .paksuco-menu li {
        position: relative
    }

    .paksuco-menu li>.group>.paksuco-arrow {
        /* transition: transform 100ms ease-in-out; */
        font-size: 10px;
    }

    /*.paksuco-menu li:hover>.group>.paksuco-arrow {
        transform: rotateZ(180deg);
    }*/
</style>
