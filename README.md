## Table of contents

- [\PHPLegends\Collections\ListCollection](#class-phplegendscollectionslistcollection)
- [\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)
- [\PHPLegends\Collections\MathCollection](#class-phplegendscollectionsmathcollection)
- [\PHPLegends\Collections\RecursiveCollection](#class-phplegendscollectionsrecursivecollection)
- [\PHPLegends\Collections\Contracts\Modifiable (interface)](#interface-phplegendscollectionscontractsmodifiable)
- [\PHPLegends\Collections\Contracts\Collectible (interface)](#interface-phplegendscollectionscontractscollectible)
- [\PHPLegends\Collections\Contracts\Accessible (interface)](#interface-phplegendscollectionscontractsaccessible)
- [\PHPLegends\Collections\Contracts\Validatable (interface)](#interface-phplegendscollectionscontractsvalidatable)
- [\PHPLegends\Collections\Contracts\Arrayable (interface)](#interface-phplegendscollectionscontractsarrayable)
- [\PHPLegends\Collections\Exceptions\CollectionException](#class-phplegendscollectionsexceptionscollectionexception)

<hr /> 
### Class: \PHPLegends\Collections\ListCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>void</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$item</strong>)</strong> : <em>void</em> |
| public | <strong>addAll(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>void</em> |
| public | <strong>all()</strong> : <em>void</em> |
| public | <strong>chunk(</strong><em>mixed</em> <strong>$size</strong>, <em>bool</em> <strong>$preserveKeys=true</strong>)</strong> : <em>void</em> |
| public | <strong>clear()</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>contains(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Countable implementation</em> |
| public static | <strong>create(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>diff(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>void</em> |
| public | <strong>every(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>boolean</em><br /><em>Check if all elements return true in test of callback</em> |
| public | <strong>except(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\PHPLegends\Collections\Collective</em> |
| public | <strong>filter(</strong><em>\PHPLegends\Collections\callable/null/\callable</em> <strong>$callback</strong>)</strong> : <em>[\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)</em> |
| public | <strong>first(</strong><em>\PHPLegends\Collections\callable/null/\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getIterator()</strong> : <em>\ArrayIterator</em> |
| public | <strong>intersect(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>void</em> |
| public | <strong>isEmpty()</strong> : <em>boolean</em><br /><em>Is empty?</em> |
| public | <strong>jsonSerialize()</strong> : <em>array</em> |
| public | <strong>keys()</strong> : <em>array</em> |
| public | <strong>last(</strong><em>\PHPLegends\Collections\callable/null/\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>map(</strong><em>\PHPLegends\Collections\callable/null/\callable</em> <strong>$callback=null</strong>)</strong> : <em>array</em> |
| public | <strong>only(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\PHPLegends\Collections\Collective</em> |
| public | <strong>pop()</strong> : <em>mixed</em><br /><em>Removes last item from items</em> |
| public | <strong>randomItem()</strong> : <em>mixed</em> |
| public | <strong>reduce(</strong><em>\callable</em> <strong>$callback</strong>, <em>mixed/mixed/null</em> <strong>$initial=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>reject(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>void</em> |
| public | <strong>remove(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>removeAll(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>void</em> |
| public | <strong>reverse(</strong><em>bool</em> <strong>$preserveKeys=true</strong>)</strong> : <em>[\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)</em> |
| public | <strong>search(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>setItems(</strong><em>array</em> <strong>$items</strong>)</strong> : <em>void</em> |
| public | <strong>shift()</strong> : <em>mixed</em><br /><em>Shift</em> |
| public | <strong>shuffle()</strong> : <em>[\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)</em> |
| public | <strong>slice(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$length=null</strong>, <em>bool</em> <strong>$preserveKeys=true</strong>)</strong> : <em>void</em> |
| public | <strong>some(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>boolean</em><br /><em>Some value returns true.</em> |
| public | <strong>sort(</strong><em>\PHPLegends\Collections\callable/null/\callable</em> <strong>$callback=null</strong>)</strong> : <em>[\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)</em> |
| public | <strong>sortBy(</strong><em>\callable</em> <strong>$callback</strong>, <em>bool</em> <strong>$ascending=true</strong>)</strong> : <em>void</em> |
| public | <strong>sortByDesc(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>void</em> |
| public | <strong>toArray()</strong> : <em>void</em> |
| public | <strong>unique()</strong> : <em>void</em> |
| public | <strong>unshift(</strong><em>mixed</em> <strong>$item</strong>)</strong> : <em>\PHPLegends\Collections\$this</em><br /><em>Unshift</em> |

*This class implements [\PHPLegends\Collections\Contracts\Arrayable](#interface-phplegendscollectionscontractsarrayable), [\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible), \Countable, \JsonSerializable, [\PHPLegends\Collections\Contracts\Modifiable](#interface-phplegendscollectionscontractsmodifiable), [\PHPLegends\Collections\Contracts\Validatable](#interface-phplegendscollectionscontractsvalidatable), \IteratorAggregate, \Traversable*

<hr /> 
### Class: \PHPLegends\Collections\Collection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addAll(</strong><em>[\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)/[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>delete(</strong><em>int/string</em> <strong>$key</strong>)</strong> : <em>mixed</em><br /><em>Unset item from collection via index and return value</em> |
| public | <strong>get(</strong><em>string/int</em> <strong>$key</strong>)</strong> : <em>mixed</em> |
| public | <strong>getOrDefault(</strong><em>int/string</em> <strong>$key</strong>, <em>mixed/mixed/null</em> <strong>$default=null</strong>)</strong> : <em>mixed</em><br /><em>Get an item from collection and, if doesnt have, returns default value</em> |
| public | <strong>has(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>boolean</em> |
| public | <strong>merge(</strong><em>array</em> <strong>$items</strong>, <em>bool/boolean</em> <strong>$recursive=false</strong>)</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>offsetExists(</strong><em>string/int</em> <strong>$key</strong>)</strong> : <em>boolean</em> |
| public | <strong>offsetGet(</strong><em>string/int</em> <strong>$key</strong>)</strong> : <em>mixed</em> |
| public | <strong>offsetSet(</strong><em>string/int</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em> |
| public | <strong>offsetUnset(</strong><em>string/int</em> <strong>$key</strong>)</strong> : <em>void</em> |
| public | <strong>replace(</strong><em>array</em> <strong>$items</strong>, <em>bool/boolean</em> <strong>$recursive=false</strong>)</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>set(</strong><em>int/string</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>setItems(</strong><em>array</em> <strong>$items</strong>)</strong> : <em>\PHPLegends\Collections\$this</em> |
| public | <strong>sortByKeys(</strong><em>bool/mixed</em> <strong>$ascending=true</strong>)</strong> : <em>\PHPLegends\Collections\Collective</em> |
| public | <strong>values()</strong> : <em>array</em><br /><em>Returns all values in an array with "reseted" keys</em> |

*This class extends [\PHPLegends\Collections\ListCollection](#class-phplegendscollectionslistcollection)*

*This class implements \Traversable, \IteratorAggregate, [\PHPLegends\Collections\Contracts\Validatable](#interface-phplegendscollectionscontractsvalidatable), [\PHPLegends\Collections\Contracts\Modifiable](#interface-phplegendscollectionscontractsmodifiable), \JsonSerializable, \Countable, [\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible), [\PHPLegends\Collections\Contracts\Arrayable](#interface-phplegendscollectionscontractsarrayable), \ArrayAccess, [\PHPLegends\Collections\Contracts\Accessible](#interface-phplegendscollectionscontractsaccessible)*

<hr /> 
### Class: \PHPLegends\Collections\MathCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>average(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>max(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>min(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>sum(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>mixed</em> |

*This class extends [\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)*

*This class implements [\PHPLegends\Collections\Contracts\Accessible](#interface-phplegendscollectionscontractsaccessible), \ArrayAccess, [\PHPLegends\Collections\Contracts\Arrayable](#interface-phplegendscollectionscontractsarrayable), [\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible), \Countable, \JsonSerializable, [\PHPLegends\Collections\Contracts\Modifiable](#interface-phplegendscollectionscontractsmodifiable), [\PHPLegends\Collections\Contracts\Validatable](#interface-phplegendscollectionscontractsvalidatable), \IteratorAggregate, \Traversable*

<hr /> 
### Class: \PHPLegends\Collections\RecursiveCollection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getIterator()</strong> : <em>\RecursiveArrayIterator</em><br /><em>Overwrites the parent method to make a recursive iterator</em> |
| public | <strong>isRecursive(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>bool</em><br /><em>Detects if the index passed is a recursive in collection</em> |
| public | <strong>setItems(</strong><em>array</em> <strong>$items</strong>)</strong> : <em>void</em> |

*This class extends [\PHPLegends\Collections\Collection](#class-phplegendscollectionscollection)*

*This class implements [\PHPLegends\Collections\Contracts\Accessible](#interface-phplegendscollectionscontractsaccessible), \ArrayAccess, [\PHPLegends\Collections\Contracts\Arrayable](#interface-phplegendscollectionscontractsarrayable), [\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible), \Countable, \JsonSerializable, [\PHPLegends\Collections\Contracts\Modifiable](#interface-phplegendscollectionscontractsmodifiable), [\PHPLegends\Collections\Contracts\Validatable](#interface-phplegendscollectionscontractsvalidatable), \IteratorAggregate, \Traversable*

<hr /> 
### Interface: \PHPLegends\Collections\Contracts\Modifiable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>chunk(</strong><em>mixed</em> <strong>$amont</strong>, <em>bool/boolean</em> <strong>$preserveKeys=true</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\Collection</em> |
| public | <strong>diff(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>filter(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>intersect(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>map(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>reject(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>reverse(</strong><em>bool/boolean</em> <strong>$preserveKeys=true</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>shuffle()</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>slice(</strong><em>int</em> <strong>$offset</strong>, <em>null/int</em> <strong>$limit</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em><br /><em>Returns the slice for collection</em> |
| public | <strong>sort(</strong><em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>sortBy(</strong><em>\PHPLegends\Collections\Contracts\callable/null/\callable</em> <strong>$callback</strong>, <em>bool/boolean</em> <strong>$ascending=true</strong>)</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |
| public | <strong>unique()</strong> : <em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> |

<hr /> 
### Interface: \PHPLegends\Collections\Contracts\Collectible

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>)</strong> : <em>void</em> |
| public | <strong>add(</strong><em>mixed</em> <strong>$item</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\$this</em><br /><em>Adds an item in collection</em> |
| public | <strong>addAll(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\$this</em><br /><em>Adds all items of another collection in this collection</em> |
| public | <strong>all()</strong> : <em>array</em><br /><em>Gives all itens from collection</em> |
| public | <strong>contains(</strong><em>mixed</em> <strong>$item</strong>)</strong> : <em>boolean</em><br /><em>Checks if this Collection contains an determined item</em> |
| public | <strong>keys()</strong> : <em>array</em> |
| public | <strong>remove(</strong><em>mixed</em> <strong>$item</strong>)</strong> : <em>void</em><br /><em>Removes an item from collection</em> |
| public | <strong>removeAll(</strong><em>[\PHPLegends\Collections\Contracts\Collectible](#interface-phplegendscollectionscontractscollectible)</em> <strong>$collection</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\$this</em><br /><em>Removes all from this collection based on another collection</em> |
| public | <strong>search(</strong><em>int/string</em> <strong>$key</strong>)</strong> : <em>int/string/false</em><br /><em>Searches element by index in collecion</em> |

<hr /> 
### Interface: \PHPLegends\Collections\Contracts\Accessible

> Interface for key value collection. Contract for use named keys in collection

| Visibility | Function |
|:-----------|:---------|
| public | <strong>delete(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>mixed</em><br /><em>Delete an item from Collection by index</em> |
| public | <strong>except(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\Collection</em><br /><em>Returns all elements of Collection, except the specified in $keys</em> |
| public | <strong>get(</strong><em>int/\PHPLegends\Collections\Contracts\key</em> <strong>$key</strong>)</strong> : <em>mixed</em><br /><em>Description</em> |
| public | <strong>has(</strong><em>int/string</em> <strong>$key</strong>)</strong> : <em>boolean</em><br /><em>Checks if key exists in Collection</em> |
| public | <strong>keys()</strong> : <em>array</em><br /><em>All keys of Collection</em> |
| public | <strong>merge(</strong><em>array</em> <strong>$items</strong>, <em>bool/boolean</em> <strong>$recursive=false</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\$this</em> |
| public | <strong>only(</strong><em>array</em> <strong>$keys</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\Collection</em><br /><em>Returns elements in collection specified in $keys</em> |
| public | <strong>replace(</strong><em>array</em> <strong>$items</strong>, <em>bool/boolean</em> <strong>$recursive=false</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\$this</em><br /><em>Replaces items in Collection</em> |
| public | <strong>set(</strong><em>int/\PHPLegends\Collections\Contracts\key</em> <strong>$key</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\PHPLegends\Collections\Contracts\self</em><br /><em>Description</em> |
| public | <strong>sortByKeys(</strong><em>bool/boolean</em> <strong>$ascending=true</strong>)</strong> : <em>void</em> |

<hr /> 
### Interface: \PHPLegends\Collections\Contracts\Validatable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>every(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>boolean</em><br /><em>Checks if every elements returns true</em> |
| public | <strong>isEmpty()</strong> : <em>boolean</em><br /><em>This Collection is Empty?</em> |
| public | <strong>some(</strong><em>\callable</em> <strong>$callback</strong>)</strong> : <em>boolean</em><br /><em>Checks if at least one element returns true</em> |

<hr /> 
### Interface: \PHPLegends\Collections\Contracts\Arrayable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>toArray()</strong> : <em>array</em> |

<hr /> 
### Class: \PHPLegends\Collections\Exceptions\CollectionException

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

