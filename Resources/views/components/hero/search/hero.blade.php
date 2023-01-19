<div class="cmp-hero">
  <section class="it-hero-wrapper bg-white align-items-start">
    <div class="it-hero-text-wrapper {{wrapper-class}}">
      {{#if icon}}
        <div class="categoryicon-top d-flex">
          <svg class="icon icon-success {{iconClass}}" aria-hidden="true">
            <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#{{icon}}"></use>
          </svg>
          <h1 class="text-black hero-title" data-element="page-name">{{hero-title}}</h1>
        </div>
      {{else}}
        <h1 class="text-black hero-title" data-element="page-name">{{{hero-title}}}</h1>
      {{/if}}

      {{#if hero-text}}
        <div class="hero-text">
          <p>{{{hero-text}}}</p>
        </div>
      {{/if}}
    </div>
  </section>
</div>