@extends('layouts.app')

@section('content')
  <div id="app" class="container">
    <ais-index app-id="{{ config('scout.algolia.id') }}"
                api-key="{{ env('ALGOLIA_SEARCH') }}"
                index-name="posts">
      <h1>Search for Posts</h1>
      <ais-search-box placeholder="Search for a post..." class="form-control input-lg">

      </ais-search-box>
      <hr />

      <ais-results>
        
      </ais-results>
    </ais-index>
  </div>
@endsection
