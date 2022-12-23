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
          title: "Centro del Afiliado",
          icon: "assignment_ind",
          path: {
            name: "afiliadoShow",
            params: { scenario: "centroAfiliado" },
          },
        },
        {
          title: "Checkout Tarjeta",
          icon: "credit_card",
          path: {
            name: "checkoutTarjeta",
          },
          gate: "checkout_access",
        },
        {
          title: "Firma Digital",
          icon: "fingerprint",
          path: { name: "firmarDocumento" },
          gate: "firma_digital_access",
        },
        {
          title: "Recaudaciones",
          icon: "table_view",
          path: { name: "recaudacione" },
          gate: "recaudacione_access",
          children: [
            {
              title: "Casos",
              icon: "table_view",
              path: { name: "casos.index" },
              gate: "caso_access",
            },
            {
              title: "Reclamos",
              icon: "table_view",
              path: { name: "reclamos.index" },
              gate: "reclamo_access",
            },
            {
              title: "Resumen de Reclamos",
              icon: "table_view",
              path: { name: "resumenReclamos.index" },
              gate: "reclamo_access",
            },
            {
              title: "Honorarios",
              icon: "table_view",
              path: { name: "reclamo_honorarios.index" },
              gate: "reclamo_access",
            },
            {
              title: "UMA",
              icon: "table_view",
              path: { name: "uma.index" },
              gate: "reclamo_access",
            },
            {
              title: "Tipo de Causa",
              icon: "table_view",
              path: { name: "tipoCausa.index" },
              gate: "reclamo_access",
            },
          ],
        },
        {
          title: "Ley 11790",
          icon: "table_view",
          path: { name: "ley11790" },
          gate: "ley11790_access",
          children: [
            {
              title: "Crear Reclamo 11790",
              icon: "verified_user",
              path: { name: "ley11790" },
              gate: "ley11790_access",
            },
            {
              title: "Ley 11790 - Tabla",
              icon: "event_available",
              path: { name: "ley11790Tabla" },
              gate: "ley11790_access",
            },
          ],
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
        },

        {
          title: "CRM",
          icon: "groups",
          path: { name: "crm" },
          gate: "crm_access", //cambiar despues
        },
        {
          title: "Debito Automatico",
          icon: "account_balance_wallet",
          path: { name: "acuerdosDeApremios" },
          gate: "debito_automatico_access",
          children: [
            {
              title: "Afiliados con Apremio",
              icon: "verified_user",
              path: { name: "acuerdosDeApremios" },
              gate: "debito_automatico_access", //cambiar despues??
            },
            {
              title: "Apremios con DA",
              icon: "account_balance",
              path: { name: "apremiadosConDA" },
              gate: "debito_automatico_access", //cambiar despues??
            },
          ],
        },
        {
          title: "Imputaciones",
          icon: "check",
          path: { name: "gestionPagos" },
          gate: "imputaciones_access",
          children: [
            {
              title: "Informes Pagos",
              icon: "attach_money",
              path: { name: "gestionPagos" },
              gate: "imputaciones_access", //cambiar despues??
            },
            {
              title: "Operaciones",
              icon: "library_books",
              path: { name: "operaciones" },
              gate: "imputaciones_access", //cambiar despues??
            },
          ],
        },
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
