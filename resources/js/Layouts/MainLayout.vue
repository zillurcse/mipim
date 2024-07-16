<template>

    <div>

        <header>
            <nav class="navbar navbar-expand-xl bg-transparent text-brand container main-nav px-4">
                <Link class="navbar-brand text-brand" href="/">
                    <img
                        src="https://mipim-file.s3.amazonaws.com/public/logo/gMYl3ElSYwvgWPzF73kSMk3FQCIRvuoe3P79AkrN.svg"
                        alt=""/>
                </Link>
                <button class="navbar-toggler bg-transparent text-black px-3 py-2" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="30px" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
                <div class="offcanvas offcanvas-end" id="navbarOffcanvas" tabindex="-1"
                     aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <ul class="navbar-nav mb-2 mb-lg-0 gap-4 text-uppercase">
                                <li class="nav-item">
                                    <Link class="nav-link active" href="/" target="_self" title="Home">Home</Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link " href="/about" target="_self" title="About">About</Link>
                                </li>
                                <!-- <li class="nav-item">
                                    <Link class="nav-link " href="/projects" target="_self" title="categorie">
                                        Projects</Link>
                                </li> -->
                                <li class="nav-item dropdown">
                                    <Link class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                          data-bs-toggle="dropdown" aria-expanded="false">
                                        Projects
                                    </Link>
                                    <ul class="dropdown-menu dropdown-menu-scrollable scrollbar-hidden"
                                        aria-labelledby="navbarDropdown">
                                        <li v-for="(  content, index  ) in  contentItems " :key="index">
                                            <Link class="dropdown-item" :href="slugByRoute(content.slug)">
                                                {{ content.title.substring(0, 20) }}
                                            </Link>
                                        </li>

                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link " href="/contact" target="_self" title="Contact us">Contact us
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" v-if="bannerItems">
                    <!-- <div v-for="(item, index) in items" :key="index"
                            :class="{ 'carousel-item': true, 'active': index === 0 }">
                            <img :src="item.banner_image" class="d-block w-100" :alt="'Image ' + (index + 1)">
                        </div> -->
                    <div v-for="(item, index) in bannerItems" :key="index"
                         :class="{ 'carousel-item': true, 'active': index === 0 }"
                         :style="{ 'background-image': 'url(' + item.banner_image + ')' }">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true">
                        <svg width="21" height="37" viewBox="0 0 21 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_110)">
                                <path
                                    d="M6.0604 18.4297L8.31543 20.8213L21 33.6236L17.6174 37L0.704695 20.1179C-0.281881 19.1331 -0.281881 17.7262 0.704695 16.7414L17.6174 -0.140686L21 3.37643L8.31543 16.038L6.0604 18.4297Z"
                                    fill="#F5F5F5"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_15_110">
                                    <rect width="21" height="37" fill="white"
                                          transform="translate(21 37) rotate(180)"/>
                                </clipPath>
                            </defs>
                        </svg>

                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true">
                        <svg width="21" height="37" viewBox="0 0 21 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_108)">
                                <path
                                    d="M14.9396 18.5703L12.6846 16.1787L0 3.37643L3.38255 0L20.2953 16.8821C21.2819 17.8669 21.2819 19.2738 20.2953 20.2586L3.38255 37.1407L0 33.6236L12.6846 20.962L14.9396 18.5703Z"
                                    fill="#F5F5F5"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_15_108">
                                    <rect width="21" height="37" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>

                    </span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </header>

        <main>
            <slot></slot> <!-- This slot will be filled with the content of the page -->
        </main>

        <!-- Footer content -->
        <footer>
            <p class="text-xs">© Ministry of Housing and Urban Planning, Oman. 2024 </p>
        </footer>

    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue'

export default {
    props: {
        bannerItems: Array,
        contentItems: Array
    },
    components: {
        Link,
    },
    data() {
        return {}
    },
    mounted() {

    },
    methods: {
        slugByRoute(slug) {
            return this.$inertia.page.component === 'Welcome' ? '/project/' + slug : slug
        }
    }
}
</script>

<style>
.dropdown-menu-scrollable {
    max-height: 300px;
    /* Adjust the height as needed */
    overflow-y: auto;
}

.scrollbar-hidden {
    -ms-overflow-style: none;
    scrollbar-width: none;
    /* Firefox */
}
</style>
