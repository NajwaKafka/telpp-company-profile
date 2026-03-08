<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Creed;
use App\Models\Product;
use App\Models\News;
use App\Models\Menu;
use App\Models\Sustainability;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@telpp.com'],
            [
                'name' => 'Admin TeLpp',
                'password' => Hash::make('password'),
            ]
        );

        // Initial Company Profile (Current Live Version)
        CompanyProfile::updateOrCreate(
            ['history_title' => 'World-Class Pulp Manufacturer'],
            [
                'history_description' => "PT Tanjungenim Lestari Pulp and Paper ( TeL) is world class manufacturer of high product quality and environmental friendly market pulp mill. This was established on June 18, 1990, commenced construction in mid-1997 and the commercial operation started on May, 2000 . The mill is located in 1,250 ha area in the Banuayu village, District Empat Petulai Dangku, Muara Enim Regency, South Sumatra province, Indonesia.\n\nTeL is a Foreign Investment Company (PMA)- Marubeni Corporation , Japan , as the National Vital Objects Industrial sector (OVNI) declared by the Minister of Industry in 2014 . The mill has market pulp production capacity of 490,000 Adt / year. Presently mill has 1600 employees and support workforce together where ~ 80% of them are residents of South Sumatra",
                'creed_statement' => "To Achieve sustainable growth in the pulp and paper industry and to operate in harmony with all stake holder and environment for creating long-term prosperity and better quality of life.",
            ]
        );

        // Creeds
        $creeds = [
            [
                'title_jp' => '正',
                'title_en' => 'Fairness',
                'tagline' => 'To be fair and decent.',
                'description' => 'We shall comply with the laws and follow fair corporate practices.',
                'order' => 1
            ],
            [
                'title_jp' => '新',
                'title_en' => 'Innovation',
                'tagline' => 'To be active and innovative.',
                'description' => 'We shall constantly strive hard to improve our performance.',
                'order' => 2
            ],
            [
                'title_jp' => '和',
                'title_en' => 'Harmony',
                'tagline' => 'To respect each other and cooperate.',
                'description' => 'We shall stay in touch with society and stakeholders by engaging in corporate activities which advance our credibility as preferred principals.',
                'order' => 3
            ],
        ];

        foreach ($creeds as $creed) {
            Creed::updateOrCreate(
                ['title_en' => $creed['title_en']],
                $creed
            );
        }

        // Dummy Product
        Product::updateOrCreate(
            ['slug' => 'bleached-kraft-pulp'],
            [
                'name' => 'Bleached Kraft Pulp',
                'description' => 'High-quality environmental friendly market pulp produced with state-of-the-art technology.',
                'is_featured' => true,
            ]
        );

        // Dummy News
        News::updateOrCreate(
            ['slug' => 'telpp-achieves-pefc-recertification'],
            [
                'title' => 'TeLpp Achieves PEFC Re-certification',
                'summary' => 'Our commitment to sustainable forest management is reaffirmed with the successful PEFC audit.',
                'content' => 'Full article content about the certification process and environmental impact...',
                'published_at' => now(),
                'is_published' => true,
            ]
        );

        // Seed Sustainability
        $sustainabilities = [
            [
                'category' => 'forest',
                'title' => 'Sustainable Forest Management',
                'slug' => 'sustainable-forest-management',
                'description' => 'Implementing the highest standards of silviculture to ensure our eucalyptus plantations grow in harmony with natural biodiversity corridors. We set aside 30% of our concession for conservation.',
                'icon' => 'forest',
                'order' => 1
            ],
            [
                'category' => 'forest',
                'title' => 'Biodiversity Corridors',
                'slug' => 'biodiversity-corridors',
                'description' => 'We maintain and protect natural forest corridors that allow wildlife to move safely between habitats, preserving the delicate balance of North Sumatra flora and fauna.',
                'icon' => 'park',
                'order' => 2
            ],
            [
                'category' => 'community',
                'title' => 'People Development & ESG',
                'slug' => 'people-development-esg',
                'description' => 'Empowering local communities through the Toba Pulp Lestari Foundation, focusing on education, healthcare, and local entrepreneurship through our partnership programs.',
                'icon' => 'groups',
                'order' => 3
            ],
            [
                'category' => 'community',
                'title' => 'Healthcare Access Program',
                'slug' => 'healthcare-access-program',
                'description' => 'Mobile clinics and medical aid provided to remote villages surrounding our operations, ensuring that quality healthcare is accessible to all stakeholders.',
                'icon' => 'health_and_safety',
                'order' => 4
            ],
            [
                'category' => 'environment',
                'title' => 'Closed-Loop Production',
                'slug' => 'closed-loop-production',
                'description' => 'Our mill utilizes advanced closed-loop water systems and biomass energy, ensuring that industrial processes minimize waste and maximize resource efficiency.',
                'icon' => 'cyclone',
                'order' => 5
            ],
            [
                'category' => 'environment',
                'title' => 'Solar Energy Integration',
                'slug' => 'solar-energy-integration',
                'description' => 'Transitioning our industrial facilities to renewable sources with our multi-megawatt solar farm initiative, significantly reducing our carbon footprint.',
                'icon' => 'solar_power',
                'order' => 6
            ],
            [
                'category' => 'governance',
                'title' => 'Anti-Corruption & Ethics',
                'slug' => 'anti-corruption-ethics',
                'description' => 'Upholding the highest standards of corporate transparency and integrity through rigorous whistleblowing systems and regular third-party audits.',
                'icon' => 'gavel',
                'order' => 7
            ],
        ];

        // Seed Sustainability
        $sustainabilities = [
            ['category' => 'forest', 'title' => 'Sustainable Forest Management', 'slug' => 'sustainable-forest-management', 'description' => 'Implementing the highest standards of silviculture...', 'icon' => 'forest', 'order' => 1],
            ['category' => 'forest', 'title' => 'Biodiversity Corridors', 'slug' => 'biodiversity-corridors', 'description' => 'Protecting natural forest corridors...', 'icon' => 'park', 'order' => 2],
            ['category' => 'community', 'title' => 'People Development & ESG', 'slug' => 'people-development-esg', 'description' => 'Empowering local communities...', 'icon' => 'groups', 'order' => 3],
            ['category' => 'community', 'title' => 'Healthcare Access Program', 'slug' => 'healthcare-access-program', 'description' => 'Mobile clinics and medical aid...', 'icon' => 'health_and_safety', 'order' => 4],
            ['category' => 'environment', 'title' => 'Closed-Loop Production', 'slug' => 'closed-loop-production', 'description' => 'Advanced water systems and biomass energy...', 'icon' => 'cyclone', 'order' => 5],
            ['category' => 'environment', 'title' => 'Solar Energy Integration', 'slug' => 'solar-energy-integration', 'description' => 'Transitioning facility to renewable energy...', 'icon' => 'solar_power', 'order' => 6],
            ['category' => 'governance', 'title' => 'Anti-Corruption & Ethics', 'slug' => 'anti-corruption-ethics', 'description' => 'Integrity through whistlesblowing systems...', 'icon' => 'gavel', 'order' => 7],
            // Items from User's Menu List
            ['category' => 'environment', 'title' => 'Pulp Process Efficiency', 'slug' => 'pulp-process', 'description' => 'State-of-the-art pulp manufacturing efficiency...', 'icon' => 'factory', 'order' => 8],
            ['category' => 'environment', 'title' => 'Supply Chain Management', 'slug' => 'supply-chain-management', 'description' => 'Optimized logistics for lower carbon footprint...', 'icon' => 'local_shipping', 'order' => 9],
            ['category' => 'community', 'title' => 'Local Community Development', 'slug' => 'local-community-development', 'description' => 'Strategic partnerships with local residents...', 'icon' => 'volunteer_activism', 'order' => 10],
        ];

        foreach ($sustainabilities as $item) {
            Sustainability::updateOrCreate(['slug' => $item['slug']], $item);
        }

        // Seed Menus
        $parentSustainability = Menu::updateOrCreate(['name' => 'Sustainability'], ['url' => '#', 'is_actived' => 1]);
        
        $subMenus = [
            ['name' => 'Forest Management', 'url' => '/sustainability/sustainable-forest-management', 'parent_id' => $parentSustainability->id],
            ['name' => 'People Development', 'url' => '/sustainability/people-development-esg', 'parent_id' => $parentSustainability->id],
            ['name' => 'Supply Chain', 'url' => '/sustainability/supply-chain-management', 'parent_id' => $parentSustainability->id],
            ['name' => 'Pulp Process', 'url' => '/sustainability/pulp-process', 'parent_id' => $parentSustainability->id],
            ['name' => 'Safety & Health', 'url' => '/sustainability/safety-health', 'parent_id' => $parentSustainability->id],
        ];

        foreach ($subMenus as $sub) {
            Menu::updateOrCreate(['name' => $sub['name']], $sub);
        }

        $csrParent = Menu::updateOrCreate(
            ['name' => 'Corporate Social Responsibility'], 
            ['url' => '/sustainability/people-development-esg', 'parent_id' => $parentSustainability->id, 'is_actived' => 1]
        );

        $csrSubMenus = [
            ['name' => 'Vision And Mission', 'url' => '/sustainability/people-development-esg', 'parent_id' => $csrParent->id],
            ['name' => 'Local Community Development', 'url' => '/sustainability/local-community-development', 'parent_id' => $csrParent->id],
            ['name' => 'CSR Report', 'url' => '/sustainability/people-development-esg', 'parent_id' => $csrParent->id],
        ];

        foreach ($csrSubMenus as $sub) {
            Menu::updateOrCreate(['name' => $sub['name']], $sub);
        }
    }
}
