<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <event-hub></event-hub>
    <side-bar :sidebarLinks="sidebarLinks">
      <mobile-menu slot="content"></mobile-menu>
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>
      <div class="content">
        <dashboard-content></dashboard-content>
      </div>
    </div>
  </div>
</template>

<script>
import DashboardContent from "./Content.vue";
import TopNavbar from "./TopNavbar.vue";
import MobileMenu from "./MobileMenu.vue";

export default {
  components: {
    DashboardContent,
    TopNavbar,
    MobileMenu,
  },
  // https://materializecss.com/icons.html para sacar los iconos
  data() {
    return {
      sidebarLinks: [
        {
          title: "Panel Informativo",
          icon: "dashboard",
          path: { name: "dashboard" },
        },
        {
          title: "Gestión de Usuarios",
          icon: "person",
          path: { name: "user_management" },
          gate: "user_management_access",
          children: [
            {
              title: "Permisos",
              icon: "perm_data_setting",
              path: { name: "permissions.index" },
              gate: "permission_access",
            },
            {
              title: "Roles",
              icon: "group",
              path: { name: "roles.index" },
              gate: "role_access",
            },
            {
              title: "Usuarios",
              icon: "person",
              path: { name: "users.index" },
              gate: "user_access",
            },
          ],
        }
      ],
    };
  },
};
</script>

<style scoped>
.content {
  margin-top: 10px !important;
}
</style>
