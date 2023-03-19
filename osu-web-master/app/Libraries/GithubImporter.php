<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Build;
use App\Models\ChangelogEntry;

class GithubImporter
{
    public $eventType;
    public $data;
    public $repository;

    public function __construct($params)
    {
        $this->data = $params['data'];
        $this->eventType = $params['eventType'];
        $this->repository = $this->data['repository']['name'];
    }

    public function import()
    {
        if ($this->repository === OsuWiki::repository() && $this->isPushTo(OsuWiki::branch())) {
            OsuWiki::updateFromGithub($this->data);
        } elseif ($this->isMergedPullRequest()) {
            return ChangelogEntry::importFromGithub($this->data);
        } elseif ($this->isNewRelease()) {
            return Build::importFromGithubNewRelease($this->data);
        }
    }

    public function isMergedPullRequest()
    {
        return $this->eventType === 'pull_request' &&
            $this->data['action'] === 'closed' &&
            $this->data['pull_request']['merged'];
    }

    public function isNewRelease()
    {
        return $this->eventType === 'release' && $this->data['action'] === 'published';
    }

    public function isPushTo(string $branch): bool
    {
        return $this->eventType === 'push' &&
            $this->data['ref'] === 'refs/heads/'.$branch;
    }
}
