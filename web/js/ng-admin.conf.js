var app = angular.module('myApp', ['ng-admin']);

// Deal with query parameters expected by StanLemon bundle
app.config(function(RestangularProvider) {
    RestangularProvider.addFullRequestInterceptor(function(element, operation, what, url, headers, params) {
        if (operation == "getList") {
            // custom pagination params
            params._start = (params._page - 1) * params._perPage;
            params._end = params._page * params._perPage;
            delete params._page;
            delete params._perPage;

            // custom sort params
            if (params._sortField) {
                params._orderBy = params._sortField;
                params._orderDir = params._sortDir;
                delete params._sortField;
                delete params._sortDir;
            }

            // custom filters
            if (params._filters) {
                for (var filter in params._filters) {
                    params[filter] = params._filters[filter];
                }
                delete params._filters;
            }
        }

        return { params: params };
    });
});

/* Define a `config` block for each entity, allowing to split configuration
 across several files. */
app.config(function($provide, NgAdminConfigurationProvider) {
    $provide.factory("ProduitAdmin", function() {
        var nga = NgAdminConfigurationProvider;
        var produit = nga.entity('produit');

        // Dashboard (as list) won't display referenced list of items.
        produit.dashboardView()
            .fields([
                nga.field('id', 'number'),
                nga.field('name', 'string'),
                nga.field('description', 'text'),
                // We limit to 3 number of fields displayed on dashboard
            ]);

        produit.listView()
            .fields([
                nga.field('id', 'number'),
                nga.field('name', 'string'),
                nga.field('description', 'text'),
                // Take more meaningful field. Here, use `name` instead of `id`
                nga.field('categorie', 'reference_many')
                    .targetEntity(nga.entity('categorie'))
                    .targetField(nga.field('name')),
            ])
            .listActions(['show', 'edit', 'delete']);

        produit.creationView()
            .fields([
                // Do not display id: we don't have any yet
                nga.field('name', 'string'),
                nga.field('description', 'text'),
                nga.field('categorie', 'reference_many')
                    .targetEntity(nga.entity('categorie'))
                    .targetField(nga.field('name')),
                // No referenced_list either, as that's a brand new entity
            ]);

        produit.editionView()
            .fields([
                nga.field('id', 'number'), // don't modify id
                nga.field('name', 'string'),
                nga.field('description', 'text'),
                nga.field('categorie', 'reference_many')
                    .targetEntity(nga.entity('categoriee'))
                    .targetField(nga.field('name')),

            ]);

        /* To ease configuration per view, we repeat every field every time. If you want to display same fields
         across views, you can use for instance `post.editView().fields()` to get edition fields. */
        produit.showView()
            .fields([
                nga.field('id', 'number'),
                nga.field('name', 'string'),
                nga.field('description', 'text'),
                nga.field('categorie', 'reference_many')
                    .targetEntity(nga.entity('categorie'))
                    .targetField(nga.field('name')),

            ]);

        return produit;
    });
});

// Same config block for comments
// Same config block for tags

app.config(function(NgAdminConfigurationProvider, ProduitAdminProvider) {
    var admin = NgAdminConfigurationProvider
        .application('')
        .baseApiUrl('/app_api.php/')

    admin
        .addEntity(ProduitAdminProvider.$get())
        //.addEntity(CategorieAdminProvider.$get())
    ;

    NgAdminConfigurationProvider.configure(admin);
});