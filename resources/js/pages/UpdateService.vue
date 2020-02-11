<template>
    <div class="row">
        <div class="col-md-12">
            <fg-input type="text"
                label="Service Name"
                placeholder="Input the name of service"
                v-model="serviceName">
            </fg-input>
            <div class="form-group">
                <label>Select Service Type (Optional)</label>
                <select
                    class="selectpicker form-control"
                    data-style="btn btn-danger btn-block"
                    title="Single Select"
                    ata-size="7"
                    v-model="serviceType">
                    <option value="">None</option>
                    <option
                        v-for="serviceType in serviceTypesHolder"
                        :key="serviceType.id"
                        :value="serviceType.id"
                        v-text="serviceType.name">
                    </option>
                </select>
            </div>
            <br>
            <button class="btn btn-primary" @click="submitService">
                Submit
            </button>
        </div>
    </div>
</template>
<script>
import NotificationTemplate from '../pages/Notifications/NotificationTemplate';
import EditProfileForm from "./UserProfile/EditProfileForm.vue";
import UserCard from "./UserProfile/UserCard.vue";
import MembersCard from "./UserProfile/MembersCard.vue";
export default {
  components: {
    EditProfileForm,
    UserCard,
    MembersCard,
    NotificationTemplate
  },
  data() {
    return {
      serviceName: '',
      serviceType: '',
      serviceTypesHolder: [],
    };
  },
  mounted () {
    this.fetchService();
    this.fetchServiceTypes();
  },
  methods: {
    fetchService() {
      this.$axios.get(`api/services/${this.$route.params.id}`)
        .then((response) => {
          this.serviceName = response.data.name;
          this.serviceType = response.data.service_type_id;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    fetchServiceTypes() {
      this.$axios.get('/api/service-types', {
        status: 1
      }).then((response) => {
        this.serviceTypesHolder = response.data;
      }).catch((error) => {
        console.log(error)
      })
    },
    submitService() {
      this.$axios.patch(
          `api/services/${this.$route.params.id}`,{
            name: this.serviceName,
            service_type_id: this.serviceType
        }).then((response) => {
        console.log(response);
        this.hmo = '';
        this.discount = '';
        this.$notify({
            message: 'Service Successfully Created',
            component: NotificationTemplate,
            icon: "ti-close",
            horizontalAlign: 'right',
            verticalAlign: 'top',
            type: 'success'
        });
      }).catch((error) => {
        console.log(error);
        this.$notify({
            message: 'Something went wrong',
            component: NotificationTemplate,
            icon: "ti-close",
            horizontalAlign: 'right',
            verticalAlign: 'top',
            type: 'danger'
        });
      })
    },
  },
};
</script>
<style>
</style>
