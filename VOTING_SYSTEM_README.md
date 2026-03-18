# Association Election Voting System

## Overview
Production-ready voting system for association elections with device-specific security. The device used to set up the election is the only device authorized to manage and conduct voting.

## Features

### Security
- **Device Fingerprinting**: Elections are bound to the device that created them
- **Anonymous Voting**: Votes are stored with cryptographic hashes, not linked to voter identities
- **One Vote Per Voter**: System prevents duplicate voting
- **Access Control**: Only the setup device can manage elections and access voting booth

### Functionality
- Create elections with multiple candidates
- Manage voter registration
- Real-time voting booth interface
- Live results and analytics
- Voter turnout tracking

## Setup Instructions

### 1. Create an Election
1. Log in to your account
2. Navigate to Dashboard
3. Click "Create New Election"
4. Fill in election details:
   - Election name
   - Description
   - Start date/time
   - End date/time
5. Add at least 2 candidates with names and optional bios
6. Click "Create Election"

**IMPORTANT**: The device you use for this step will be the ONLY device that can manage this election.

### 2. Add Voters
1. From the election management page, add voters one by one
2. Each voter needs:
   - Full name
   - Unique voter ID (can be membership number, email, etc.)
3. Voters will use their voter ID to authenticate in the voting booth

### 3. Activate Election
1. Ensure you have added all voters
2. Click "Activate Election"
3. Election is now live and voters can cast their votes

### 4. Voting Process
1. Share the voting URL with voters: `/election/{id}/vote`
2. Voters enter their voter ID to authenticate
3. Select their preferred candidate
4. Confirm their vote (irreversible)
5. System marks voter as "voted" and records anonymous vote

### 5. Monitor & Close
- View real-time results from the management page
- Monitor voter turnout
- Close election manually or wait for end date/time
- View final results with percentages and vote counts

## Routes

### Authenticated (Admin)
- `/dashboard` - Main dashboard with election list
- `/election/setup` - Create new election
- `/election/{id}/manage` - Manage specific election

### Public (Voters)
- `/election/{id}/vote` - Voting booth (device-restricted)
- `/election/{id}/results` - View results (device-restricted)

## Database Schema

### Elections
- name, description
- starts_at, ends_at
- device_fingerprint (security)
- status (setup, active, closed)

### Candidates
- election_id
- name, bio, photo
- position (ordering)

### Voters
- election_id
- voter_id (unique identifier)
- name
- has_voted, voted_at

### Votes
- election_id
- candidate_id
- vote_hash (anonymous identifier)

## Security Features

### Device Fingerprinting
The system generates a unique fingerprint based on:
- User agent
- IP address
- Accept language
- Accept encoding

This fingerprint is stored with the election and verified on every access to:
- Election management
- Voting booth
- Results page

### Vote Anonymity
Votes are stored with a cryptographic hash that includes:
- Voter ID
- Timestamp
- Random number

This ensures votes cannot be traced back to individual voters while preventing duplicate voting.

## Production Considerations

### Before Deployment
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Generate new `APP_KEY`: `php artisan key:generate`
4. Configure proper database (MySQL/PostgreSQL recommended)
5. Set up HTTPS/SSL certificate
6. Configure proper session driver (database/redis)
7. Set up backup system for database

### Recommended Settings
```env
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Security Checklist
- [ ] HTTPS enabled
- [ ] Strong APP_KEY generated
- [ ] Database credentials secured
- [ ] File permissions set correctly (755 for directories, 644 for files)
- [ ] Storage directory writable
- [ ] .env file not publicly accessible
- [ ] Regular database backups configured

## Usage Tips

1. **Test First**: Create a test election with a few test voters before the actual election
2. **Voter IDs**: Use consistent, easy-to-remember IDs (membership numbers, email addresses)
3. **Timing**: Set start time a few minutes in the future to allow final preparations
4. **Communication**: Send voting instructions to all voters before election starts
5. **Monitoring**: Keep the management page open during voting to monitor turnout
6. **Backup Device**: Note that only the setup device can access the election - keep it secure

## Troubleshooting

### "Access Denied" Error
- You're trying to access from a different device than the one used for setup
- Solution: Use the original device

### Voter Can't Authenticate
- Check voter ID is entered correctly (case-sensitive)
- Verify voter was added to the election
- Ensure election is active

### Can't Activate Election
- Need at least 1 voter registered
- Check that election hasn't already been activated

## Support

For issues or questions, check the application logs:
```bash
tail -f storage/logs/laravel.log
```
