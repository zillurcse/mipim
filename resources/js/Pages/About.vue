<template>
    <div class="container mx-auto bg-white p-0">
        <MainLayoutVue :contentItems="contentItems">
            <section class="about-section">
                <div class="container">
                    <div>
                        <ul class="section-link">
                            <li>Home</li>
                            <li>/</li>
                            <li class="active">About us</li>
                        </ul>
                    </div>
                    <div class="about-deatiles">
                        <p>
                            Oman, the oldestindependent state in the Arab world, is strategically diversifying its
                            economyaway from a reliance on oil and gas. Under the leadership of Sultan Haitham binTarik,
                            the country’s prime minister, this economic transformation is gaining momentum. <br />
                            <br />
                            The Oman Vision 2040programme and the Oman National Spatial Strategy[Ka1]  (ONSS) are
                            keydrivers of this change. The Vision 2040 programme aims to foster a
                            diversified,sustainable
                            national economy, ensure equitable distribution of developmentgains, and protect natural
                            resources and the environment. <br />
                            <br />
                             [Ka1]Strategy
                        </p>
                    </div>
                </div>
            </section>
        </MainLayoutVue>
    </div>


</template>

<script>

import MainLayoutVue from '../Layouts/MainLayout.vue';
export default {
    props: {

        contentItems: Array,

    },
    components: {

        MainLayoutVue
    },
}
</script>

<style></style>
