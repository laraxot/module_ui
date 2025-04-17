{{--
    passiamo a quello compilato
--}}
@verbatim
    <v-app id="inspire">
          <input type="text" id="rating" value="3">
          <v-rating
            v-model="rating"
            empty-icon='far fa-star fa-3x'
            full-icon='fas fa-star  fa-3x'
            half-icon='fas fa-star-half-alt  fa-3x'
            color="yellow darken-3"
            background-color="grey darken-1"
            half-increments
            hover
          ></v-rating>
        <div>
        <span class="caption text-uppercase">model:</span>
        <span class="font-weight-bold">
          {{ rating }}
        </span>
      </div>
  </v-app>
  @endverbatim
