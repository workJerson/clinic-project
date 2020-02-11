<template>
  <div>
    <div class="row">
        <div class="col-12">
            <div class="input-group col-4 float-left button-div">
                <input class="form-control py-2" type="search" value="Search..." id="example-search-input">
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="ti-search"></i>
                    </button>
                </span>
            </div>
            <div class="col-4 float-right button-div">
                <button class="btn btn-primary float-right" @click="createServiceRatePage">
                    Create
                    <i class="ti-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <card :title="title">
          <div slot="raw-content" class="table-responsive">
            <table class="table striped">
                <thead>
                <slot name="columns">
                <th v-for="column in tableColumns" :key="column">
                    {{ column }}
                </th>
                </slot>
                </thead>
                <tbody>
                <template v-if="is_loading !== false">
                    <tr>
                    <td colspan="4" style="text-align: center">
                        <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                    </td>
                    </tr>
                </template>
                <template v-show="is_loading === false">
                    <tr v-for="(item, index) in tableData" :key="item.id + '' + index">
                    <td v-text="item.hmo"></td>
                    <td v-text="item.service"></td>
                    <td v-text="item.rate"></td>
                    <td>
                      <button class="btn btn-primary btn-sm" @click="updateServiceRate(item.id)">
                        Edit
                      </button>
                      <button class="btn btn-danger btn-sm" @click="updateServiceRate(item.id)">
                        Remove
                      </button>
                    </td>
                    </tr>
                </template>
                </tbody>
            </table>
          </div>
            <div slot="footer">
              <nav class="left-align">
                <ul class="pagination">
                  <li
                      class="page-item"
                      :class="{ 'disabled': current_page === 1 }"
                      @click="movePage(Number(current_page) - 1)"
                      v-show="!(current_page === 1)"
                  >
                    <a class="page-link" :class="{ 'color-text': !(current_page === 1) }">{{ '<' }}</a>
                  </li>
                <template v-for="pageNumber in total">
                  <li style="cursor: pointer" class="page-item" :class="{'active': current_page === pageNumber}" :key="pageNumber" v-if="Math.abs(pageNumber - current_page) < 3 || pageNumber === total || pageNumber === 1">
                    <a
                        class="page-link"
                        v-bind:key="pageNumber"
                        :class="{
                        last: (pageNumber === total && Math.abs(pageNumber - current_page) > 3),
                        first: (pageNumber === 1 && Math.abs(pageNumber - current_page) > 3)
                        }"
                        v-text="pageNumber"
                        @click="movePage(pageNumber)"
                    >
                    </a>
                  </li>
                </template>
                  <li
                      class="page-item"
                      :class="{ 'disabled': current_page === last_page }"
                      @click="movePage(Number(current_page) + 1)"
                      v-show="!(current_page === last_page)"
                  >
                    <a class="page-link" :class="{ 'color-text': !(current_page === last_page) }"> {{ '>' }} </a>
                  </li>
                </ul>
              </nav>
            </div>
        </card>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        tableColumns: ["HMO", "Service", "Rate", "Action"],
        title: "Service Rate Master List",
        tableData: [],
        current_page: 1,
        total: 0,
        last_page: 1,
        per_page: 15,
        is_loading: true,
      };
    },
    mounted() {
      this.fetchServiceRate(1, '', '', 1);
    },
    methods: {
      updateServiceRate(id) {
        this.$router.push({ path: `service-rate-table-list/update/${id}` });
      },
      createServiceRatePage() {
        this.$router.push({ path: 'service-rate-table-list/create' });
      },
      fetchServiceRate(page, dateFrom, dateTo, status) {
        this.tableData = [];
        this.is_loading = true;
        this.$axios.get('api/service-rates', {
          params: {
            page: page,
            dateFrom: dateFrom,
            dateTo: dateTo,
            per_page: this.per_page,
          }
        }).then((response) => {
          this.is_loading = false;
          console.log(response.data);
          this.tableData = response.data.data.map((item) => {
            return {
              id: item.id,
              hmo: item.hmo.name,
              service: item.service.name,
              rate: item.total_rate,
            };
          });
          this.current_page = response.data.current_page;
          this.last_page = response.data.last_page;
          this.total = response.data.last_page;
        }).catch((error) => {
          console.warn(error);
        })
      },
      movePage(page) {
        this.fetchServiceRate(page, '', '', 1);
      },
    },
  };
</script>
<style lang="scss">
  a.first::after {
    content:'...'
  }

  a.last::before {
    content:'...'
  }

  .color-text {
    color: #007bff !important;
  }
  .button-div {
      padding: 0 !important;
      margin-bottom: 1%;
  }
</style>
