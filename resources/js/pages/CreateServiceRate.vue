<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Select HMO</label>
                <select
                    class="selectpicker form-control"
                    data-style="btn btn-danger btn-block"
                    title="Single Select"
                    ata-size="7"
                    v-model="hmo">
                    <option value="">None</option>
                    <option
                        v-for="hmo in hmoList"
                        :key="hmo.id"
                        :value="hmo.id"
                        v-text="hmo.name">
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Select Service</label>
                <select
                    class="selectpicker form-control"
                    data-style="btn btn-danger btn-block"
                    title="Single Select"
                    ata-size="7"
                    v-model="service">
                    <option value="">None</option>
                    <option
                        v-for="service in serviceList"
                        :key="service.id"
                        :value="service.id"
                        v-text="service.name">
                    </option>
                </select>
            </div>
            <fg-input type="text"
                label="Rate"
                placeholder="Input the Rate"
                v-model="rate">
            </fg-input>
            <br>
            <button class="btn btn-primary" @click="submitServiceRate">
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
      service: '',
      hmo: '',
      rate: '',
      serviceList: [],
      hmoList: [],
    };
  },
  mounted () {
      this.fetchServices();
      this.fetchHmo();
  },
  methods: {
    fetchServices() {
      this.$axios.get('/api/services', {
          status: 1
      }).then((response) => {
          this.serviceList = response.data;
      }).catch((error) => {
          console.log(error)
      })
    },
    fetchHmo() {
      this.$axios.get('/api/hmos', {
          status: 1
      }).then((response) => {
          this.hmoList = response.data;
      }).catch((error) => {
          console.log(error)
      })
    },
    submitServiceRate() {
      this.$axios.post(
          'api/service-rates',{
            h_m_o_id: this.hmo,
            service_id: this.service,
            total_rate: this.rate
        }).then((response) => {
        console.log(response);
        this.hmo = '';
        this.discount = '';
        this.$notify({
            message: 'Service Rate Successfully Created',
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
