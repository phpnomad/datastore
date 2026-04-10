# phpnomad/datastore

[![Latest Version](https://img.shields.io/packagist/v/phpnomad/datastore.svg)](https://packagist.org/packages/phpnomad/datastore) [![Total Downloads](https://img.shields.io/packagist/dt/phpnomad/datastore.svg)](https://packagist.org/packages/phpnomad/datastore) [![PHP Version](https://img.shields.io/packagist/php-v/phpnomad/datastore.svg)](https://packagist.org/packages/phpnomad/datastore) [![License](https://img.shields.io/packagist/l/phpnomad/datastore.svg)](https://packagist.org/packages/phpnomad/datastore)

`phpnomad/datastore` is the storage-agnostic data access pattern at the heart of [PHPNomad](https://phpnomad.com). It ships a small set of interfaces, traits, models, and events that let your business logic describe what data operations it needs without committing to where the data lives. It contains no concrete storage code of its own.

The pattern splits into two layers. Your Core layer holds the `Datastore` interface your application code depends on, the `DatastoreHandler` interface that storage implementations fulfill, and the domain models that flow between them. Your Service layer holds concrete handlers that talk to real storage, whether that's a SQL database, a REST API, a GraphQL endpoint, or an in-memory array for tests. `phpnomad/db` is one Service-layer implementation against SQL, and PHPNomad has been running this pattern in production for years, powering [Siren](https://sirenaffiliates.com), several MCP servers, and other client systems.

## Installation

```bash
composer require phpnomad/datastore
```

## Quick Start

The pattern centers on three files: a `Datastore` interface (your public API), a `DatastoreHandler` interface (the storage contract), and a Core implementation that wires them together with decorator traits.

Declare your public API by extending the base interfaces you need and adding any custom business methods:

```php
<?php

namespace MyApp\Core\Datastores\Post\Interfaces;

use MyApp\Core\Models\Post;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasPrimaryKey;
use PHPNomad\Datastore\Interfaces\DatastoreHasWhere;

interface PostDatastore extends Datastore, DatastoreHasPrimaryKey, DatastoreHasWhere
{
    /**
     * @return Post[]
     */
    public function getPublishedPosts(): array;
}
```

Declare the storage contract as a sibling interface. It extends the same base interfaces but stays free of business-specific methods, so any backend can implement it:

```php
<?php

namespace MyApp\Core\Datastores\Post\Interfaces;

use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasPrimaryKey;
use PHPNomad\Datastore\Interfaces\DatastoreHasWhere;

interface PostDatastoreHandler extends Datastore, DatastoreHasPrimaryKey, DatastoreHasWhere
{
}
```

Write the Core implementation once. Decorator traits delegate every standard method to the injected handler, so you only implement the custom business method:

```php
<?php

namespace MyApp\Core\Datastores\Post;

use MyApp\Core\Datastores\Post\Interfaces\PostDatastore as PostDatastoreInterface;
use MyApp\Core\Datastores\Post\Interfaces\PostDatastoreHandler;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Traits\WithDatastoreDecorator;
use PHPNomad\Datastore\Traits\WithDatastorePrimaryKeyDecorator;
use PHPNomad\Datastore\Traits\WithDatastoreWhereDecorator;

class PostDatastore implements PostDatastoreInterface
{
    use WithDatastoreDecorator;
    use WithDatastorePrimaryKeyDecorator;
    use WithDatastoreWhereDecorator;

    protected Datastore $datastoreHandler;

    public function __construct(PostDatastoreHandler $datastoreHandler)
    {
        $this->datastoreHandler = $datastoreHandler;
    }

    public function getPublishedPosts(): array
    {
        return $this->datastoreHandler->where([
            [
                'type' => 'AND',
                'clauses' => [
                    ['column' => 'status', 'operator' => '=', 'value' => 'published'],
                ],
            ],
        ]);
    }
}
```

A Service-layer class like `PostDatabaseDatastoreHandler` implements `PostDatastoreHandler` against an actual backend. You bind the handler interface to that concrete class in your DI container at bootstrap time. Swapping storage later is a one-line change to the binding. Nothing in `PostDatastore` or its callers has to move.

## Key Concepts

- `Datastore` is your public API. `DatastoreHandler` is the storage contract. Both extend the same base interfaces, but only the `Datastore` adds custom business methods.
- Base interfaces are composable. Mix `Datastore`, `DatastoreHasPrimaryKey`, `DatastoreHasWhere`, and `DatastoreHasCounts` to describe exactly the operations your entity supports, no more.
- Decorator traits (`WithDatastoreDecorator`, `WithDatastorePrimaryKeyDecorator`, `WithDatastoreWhereDecorator`, `WithDatastoreCountDecorator`) delegate the standard methods to your handler so implementations stay lean.
- `DataModel` and `ModelAdapter` keep domain entities independent of storage format. Adapters translate between raw arrays and model objects on read and write.
- `RecordCreated`, `RecordUpdated`, and `RecordDeleted` events let handler implementations broadcast state changes through `phpnomad/event` without coupling consumers to any specific storage backend.

## Documentation

Full documentation lives at [phpnomad.com](https://phpnomad.com), including the datastore conceptual overview, the Core datastore layer reference, model and adapter guidance, and the `phpnomad/db` Service-layer implementation for SQL-backed storage.

## License

MIT, see [LICENSE.txt](LICENSE.txt) for the full text.
