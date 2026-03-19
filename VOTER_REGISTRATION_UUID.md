# Voter Registration with Election UUID

## Changes Made

### 1. Database Changes
- Added `uuid` column to `elections` table (unique identifier)
- Added `election_id` foreign key to `potential_voters` table
- Existing elections automatically get UUIDs assigned

### 2. Model Updates
- **Election Model**: Auto-generates UUID on creation
- **PotentialVoter Model**: Added relationship to Election

### 3. Route Update
- Changed from: `/register-voter`
- Changed to: `/register/{uuid}`
- Example: `/register/ffca6857-1a79-4c67-a5cd-4b6964c5d21e`

### 4. Component Update
- RegisterVoter component now accepts election UUID
- Links voter registration to specific election
- Shows election name on registration form

## Usage

To get a voter registration link for an election:

```php
$election = Election::first();
$registrationUrl = route('register.voter', ['uuid' => $election->uuid]);
// Example: https://yourdomain.com/register/ffca6857-1a79-4c67-a5cd-4b6964c5d21e
```

## Benefits

1. **Security**: Election IDs are hidden from URLs
2. **Tracking**: Each registration is linked to a specific election
3. **Unique Links**: Each election has its own unique registration URL
4. **Better UX**: Shows which election the user is registering for
