<template>
    <div id="app">
        <b-navbar toggleable="md" type="dark" variant="info">
            <b-nav-toggle target="nav_collapse"></b-nav-toggle>
            <b-navbar-brand href="/">Searcher</b-navbar-brand>
            <b-collapse is-nav id="nav_collapse">
                <b-nav is-nav-bar>
                    <b-nav-item href="#/list">List</b-nav-item>
                </b-nav>
            </b-collapse>
        </b-navbar>
        <b-container>
            <router-view></router-view>
        </b-container>
    </div>
</template>
