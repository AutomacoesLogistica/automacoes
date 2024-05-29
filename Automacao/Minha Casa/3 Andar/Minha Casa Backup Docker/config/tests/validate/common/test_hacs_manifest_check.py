import pytest
from aiogithubapi.objects.repository.content import AIOGitHubAPIRepositoryTreeContent

from custom_components.hacs.validate.common.hacs_manifest import HacsManifest


@pytest.mark.asyncio
async def test_hacs_manifest_no_manifest(repository):
    check = HacsManifest(repository)
    await check._async_run_check()
    assert check.failed


@pytest.mark.asyncio
async def test_hacs_manifest_with_manifest(repository):
    repository.tree = [
        AIOGitHubAPIRepositoryTreeContent(
            {"path": "hacs.json", "type": "file"}, "test/test", "main"
        )
    ]
    check = HacsManifest(repository)
    await check._async_run_check()
    assert not check.failed
