<div class="floating-search-container" aria-label="Destination Finder">
    <div class="floating-search-card">
        <form action="{{ route('destinations') }}" method="GET" class="search-form-row">
            <!-- Search Text -->
            <div class="search-field-col">
                <span class="search-field-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <input type="text" 
                       name="q" 
                       class="search-text-input" 
                       placeholder="Search destinations..." 
                       aria-label="Search destinations by name or keyword">
            </div>

            <!-- Regions Select -->
            <div class="search-field-col">
                <span class="search-field-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </span>
                <select name="region" class="search-select-input" aria-label="Filter by Region">
                    <option value="">All Regions</option>
                    <option value="Central">Central</option>
                    <option value="East">East</option>
                    <option value="North">North</option>
                    <option value="West">West</option>
                    <option value="Southwest">Southwest</option>
                </select>
            </div>

            <!-- When / Duration Select -->
            <div class="search-field-col">
                <span class="search-field-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </span>
                <select name="duration" class="search-select-input" aria-label="Filter by Trip Duration">
                    <option value="">When?</option>
                    <option value="1 day">1 day</option>
                    <option value="Weekend">Weekend</option>
                    <option value="3 days">3 days</option>
                    <option value="5 days">5 days</option>
                    <option value="7+ days">7+ days</option>
                </select>
            </div>

            <!-- Travelers / Group Select -->
            <div class="search-field-col">
                <span class="search-field-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </span>
                <select name="group" class="search-select-input" aria-label="Filter by Travel Group">
                    <option value="">Travelers</option>
                    <option value="Solo">Solo</option>
                    <option value="Couple">Couple</option>
                    <option value="Family">Family</option>
                    <option value="Friends">Friends</option>
                    <option value="Group">Group</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-search-submit" aria-label="Submit Destination Search">
                <span>Search</span>
                <span aria-hidden="true">&rarr;</span>
            </button>
        </form>
    </div>
</div>
