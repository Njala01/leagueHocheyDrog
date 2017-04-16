          <div class="partie">
            <h2 class="partie-title">
            <a href="/partie/{{$partie->id}}">
              {{ $partie->titre }}
            </a>
            </h2>
            <p class="blog-post-meta"> 
            <span>Le match aura lieu à </span>
            	{{ $partie->lieu}} le
            	{{ Carbon\Carbon::parse($partie->date)->toFormattedDateString()}}
            </p>

            {{ $partie->body }}

          </div><!-- /.blog-post -->